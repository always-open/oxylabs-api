<?php

namespace AlwaysOpen\OxylabsApi;

use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonPricingRequest;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonPricingResponse;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonProductRequest;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonProductResponse;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonRequest;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonResponse;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonSearchRequest;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonSellerResponse;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonSellersRequest;
use AlwaysOpen\OxylabsApi\DTOs\BatchRequest;
use AlwaysOpen\OxylabsApi\DTOs\Google\GoogleShoppingPricingRequest;
use AlwaysOpen\OxylabsApi\DTOs\Google\GoogleShoppingPricingResponse;
use AlwaysOpen\OxylabsApi\DTOs\Google\GoogleShoppingProductRequest;
use AlwaysOpen\OxylabsApi\DTOs\Google\GoogleShoppingProductResponse;
use AlwaysOpen\OxylabsApi\DTOs\GoogleSearchRequest;
use AlwaysOpen\OxylabsApi\DTOs\PushPullBatchJobResponse;
use AlwaysOpen\OxylabsApi\DTOs\PushPullJob;
use AlwaysOpen\OxylabsApi\DTOs\UniversalRequest;
use AlwaysOpen\OxylabsApi\DTOs\UniversalResponse;
use AlwaysOpen\OxylabsApi\DTOs\Walmart\WalmartProductRequest;
use AlwaysOpen\OxylabsApi\DTOs\Walmart\WalmartProductResponse;
use AlwaysOpen\OxylabsApi\Models\OxylabsApiRequestLogger;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;
use RuntimeException;
use Throwable;

class OxylabsApiClient
{
    protected string $baseUrl;

    protected string $username;

    protected string $password;

    protected string $authMethod;

    /**
     * @var int|null This will coalesce with allowed retries in dispatch call
     */
    protected ?int $defaultAllowedDispatchRetries;

    public function __construct(
        ?string $baseUrl = null,
        ?string $username = null,
        ?string $password = null,
        ?string $authMethod = null,
        ?int $defaultAllowedDispatchRetries = null,
    ) {
        $this->baseUrl = rtrim($baseUrl ?? config('oxylabs-api.base_url', 'https://data.oxylabs.io/v1/'), '/');
        $this->username = $username ?? config('oxylabs-api.username') ?? '';
        $this->password = $password ?? config('oxylabs-api.password') ?? '';
        $this->authMethod = $authMethod ?? config('oxylabs-api.auth_method') ?? 'basic';
        $this->defaultAllowedDispatchRetries = $defaultAllowedDispatchRetries;
    }

    protected function getAuthHeader(): array
    {
        return match ($this->authMethod) {
            'basic' => [
                'Authorization' => 'Basic '.base64_encode($this->username.':'.$this->password),
            ],
            'bearer' => [
                'Authorization' => 'Bearer '.$this->password,
            ],
            default => throw new InvalidArgumentException('Invalid authentication method')
        };
    }

    /**
     * @throws RuntimeException
     */
    public function makePostRequest(string $source, array $payload, ?int $allowedRetries = null): PushPullJob
    {
        try {
            $response = $this->makeRequest(
                'post',
                $this->baseUrl.'/queries',
                [
                    'source' => $source,
                    ...$payload,
                ],
                $allowedRetries ?? 0,
            );

            if (! $response->successful()) {
                throw new RuntimeException('API request failed: '.$response->body(), $response->getStatusCode());
            }

            return PushPullJob::from($response->json());
        } catch (Throwable $e) {
            throw new RuntimeException('API request failed: '.$e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @throws GuzzleException|Throwable
     */
    protected function makeRequest(string $method, string $uri, ?array $payload = null, ?int $retryCount = null): Response
    {
        $request = new Request(
            method: $method,
            uri: $uri,
            headers: $this->getAuthHeader(),
            body: $payload ? json_encode($payload) : null,
        );

        if (config('oxylabs-api.request_logging_enabled', true)) {
            $logger = OxylabsApiRequestLogger::makeFromGuzzle($request);
            $logger->save();
        }

        /**
         * @var Response $response
         */
        $response = retry($retryCount ?? 0, function () use ($request, $method, $payload): PromiseInterface|Response {
            if (strtolower($method) === 'post') {
                return Http::withHeaders($request->getHeaders())
                    ->post($request->getUri(), $payload)
                    ->throw();
            } else {
                return Http::withHeaders($request->getHeaders())
                    ->get($request->getUri())
                    ->throw();
            }
        }, 2000);

        if (config('oxylabs-api.request_logging_enabled', true)) {
            $logger->updateFromResponse($response->toPsrResponse());
        }

        return $response;
    }

    /**
     * @throws RuntimeException
     */
    public function getResult(
        string $job_id,
        ?string $type = null,
    ): ?array {
        try {
            $response = $this->makeRequest(
                'get',
                $this->baseUrl."/queries/$job_id/results".($type ? "?type=$type" : ''),
                null,
                3
            );
        } catch (Throwable $e) {
            throw new RuntimeException('API request failed: '.$e->getMessage(), $e->getCode(), $e);
        }

        if (! $response->successful()) {
            throw new RuntimeException('API request failed: '.$response->body(), $response->getStatusCode());
        }

        return $response->json();
    }

    /**
     * @throws ConnectionException
     * @throws Throwable
     */
    public function getPushPullJob(string $job_id): PushPullJob
    {
        $response = $this->makeRequest(
            'get',
            $this->baseUrl."/queries/$job_id",
            retryCount: 3,
        );

        if (! $response->successful()) {
            throw new RuntimeException('API request failed: '.$response->body(), $response->getStatusCode());
        }

        return PushPullJob::from($response->json());
    }

    /**
     * @throws ConnectionException
     * @throws RuntimeException
     * @throws Throwable
     */
    public function getPushPullResults(
        string $job_id,
        bool $check_status = false,
        int $status_check_limit = 5,
        int $status_wait_seconds = 3,
        ?string $type = null,
    ): ?array {
        if ($check_status) {
            $attempts = 0;
            do {
                $job = $this->getPushPullJob($job_id);
            } while ($job->isPending() && $attempts++ < $status_check_limit && sleep($status_wait_seconds) === 0);
        }

        return $this->getResult($job_id, $type);
    }

    /**
     * @throws ConnectionException|Throwable
     */
    public function getAmazonProductResult(
        string $job_id,
        bool $check_status = false,
        int $status_check_limit = 5,
        int $status_wait_seconds = 3,
        ?string $type = 'parsed',
    ): AmazonProductResponse {
        $response = $this->getPushPullResults($job_id, $check_status, $status_check_limit, $status_wait_seconds, $type);

        return AmazonProductResponse::from($response);
    }

    /**
     * @throws ConnectionException|RuntimeException|Throwable
     */
    public function getAmazonResult(
        string $job_id,
        bool $check_status = false,
        int $status_check_limit = 5,
        int $status_wait_seconds = 3,
        ?string $type = 'parsed',
    ): AmazonResponse {
        $response = $this->getPushPullResults($job_id, $check_status, $status_check_limit, $status_wait_seconds, $type);

        return AmazonResponse::from($response);
    }

    /**
     * @throws ConnectionException|Throwable
     */
    public function getUniversalResult(
        string $job_id,
        bool $check_status = false,
        int $status_check_limit = 5,
        int $status_wait_seconds = 3,
        ?string $type = 'raw',
    ): UniversalResponse {
        $response = $this->getPushPullResults($job_id, $check_status, $status_check_limit, $status_wait_seconds, $type);

        return UniversalResponse::from($response);
    }

    /**
     * @throws ConnectionException|Throwable
     */
    public function getAmazonPricingResult(
        string $job_id,
        bool $check_status = false,
        int $status_check_limit = 5,
        int $status_wait_seconds = 3,
        ?string $type = 'parsed',
    ): AmazonPricingResponse {
        $response = $this->getPushPullResults($job_id, $check_status, $status_check_limit, $status_wait_seconds, $type);

        return AmazonPricingResponse::from($response);
    }

    /**
     * @throws ConnectionException
     * @throws Throwable
     */
    public function getAmazonSellerResult(
        string $job_id,
        bool $check_status = false,
        int $status_check_limit = 5,
        int $status_wait_seconds = 3,
        ?string $type = 'parsed',
    ): AmazonSellerResponse {
        $response = $this->getPushPullResults($job_id, $check_status, $status_check_limit, $status_wait_seconds, $type);

        return AmazonSellerResponse::from($response);
    }

    /**
     * @throws GuzzleException
     * @throws Throwable
     */
    public function makeBatchRequest(BatchRequest $payload): PushPullBatchJobResponse
    {
        $response = $this->makeRequest(
            'post',
            $this->baseUrl.'/queries/batch',
            $payload->toArray(),
            3
        );

        if (! $response->successful()) {
            throw new RuntimeException('API request failed: '.$response->body());
        }

        return PushPullBatchJobResponse::from($response->json());
    }

    /**
     * @throws RuntimeException
     */
    public function amazon(AmazonRequest $request, ?int $allowedRetries = null): PushPullJob
    {
        return $this->makePostRequest(OxylabsApi::TARGET_AMAZON, $request->toArray(), $allowedRetries);
    }

    /**
     * @throws RuntimeException
     */
    public function amazonProduct(AmazonProductRequest $request, ?int $allowedRetries = null): PushPullJob
    {
        return $this->makePostRequest(OxylabsApi::SOURCE_AMAZON_PRODUCT, $request->toArray(), $allowedRetries);
    }

    /**
     * @throws RuntimeException
     */
    public function amazonSearch(AmazonSearchRequest $request, ?int $allowedRetries = null): PushPullJob
    {
        return $this->makePostRequest(OxylabsApi::SOURCE_AMAZON_SEARCH, $request->toArray(), $allowedRetries);
    }

    /**
     * @throws RuntimeException
     */
    public function amazonPricing(AmazonPricingRequest $request, ?int $allowedRetries = null): PushPullJob
    {
        return $this->makePostRequest(OxylabsApi::SOURCE_AMAZON_PRICING, $request->toArray(), $allowedRetries);
    }

    /**
     * @throws RuntimeException
     */
    public function amazonSellers(AmazonSellersRequest $request, ?int $allowedRetries = null): PushPullJob
    {
        return $this->makePostRequest(OxylabsApi::SOURCE_AMAZON_SELLERS, $request->toArray(), $allowedRetries);
    }

    /**
     * @throws RuntimeException
     */
    public function googleSearch(GoogleSearchRequest $request, ?int $allowedRetries = null): PushPullJob
    {
        return $this->makePostRequest(OxylabsApi::SOURCE_GOOGLE_SHOPPING_SEARCH, $request->toArray(), $allowedRetries);
    }

    /**
     * @throws RuntimeException
     */
    public function universal(UniversalRequest $request, ?int $allowedRetries = null): PushPullJob
    {
        return $this->makePostRequest('universal', $request->toArray(), $allowedRetries);
    }

    /**
     * @throws RuntimeException
     */
    public function googleShoppingProduct(GoogleShoppingProductRequest $request, ?int $allowedRetries = null): PushPullJob
    {
        return $this->makePostRequest(OxylabsApi::SOURCE_GOOGLE_SHOPPING_PRODUCT, $request->toArray(), $allowedRetries);
    }

    /**
     * @throws ConnectionException
     * @throws Throwable
     */
    public function getGoogleShoppingProductResult(
        string $job_id,
        bool $check_status = false,
        int $status_check_limit = 5,
        int $status_wait_seconds = 3,
        ?string $type = 'parsed',
    ): GoogleShoppingProductResponse {
        $response = $this->getPushPullResults($job_id, $check_status, $status_check_limit, $status_wait_seconds, $type);

        return GoogleShoppingProductResponse::from($response);
    }

    /**
     * @throws RuntimeException
     */
    public function googleShoppingPricing(GoogleShoppingPricingRequest $request, ?int $allowedRetries = null): PushPullJob
    {
        return $this->makePostRequest(OxylabsApi::SOURCE_GOOGLE_SHOPPING_PRICING, $request->toArray(), $allowedRetries);
    }

    /**
     * @throws ConnectionException|Throwable
     */
    public function getGoogleShoppingPricingResult(
        string $job_id,
        bool $check_status = false,
        int $status_check_limit = 5,
        int $status_wait_seconds = 3,
        ?string $type = 'parsed',
    ): GoogleShoppingPricingResponse {
        $response = $this->getPushPullResults($job_id, $check_status, $status_check_limit, $status_wait_seconds, $type);

        return GoogleShoppingPricingResponse::from($response);
    }

    /**
     * @throws RuntimeException
     */
    public function walmartProduct(WalmartProductRequest $request, ?int $allowedRetries = null): PushPullJob
    {
        return $this->makePostRequest(OxylabsApi::SOURCE_WALMART_PRODUCT, $request->toArray(), $allowedRetries);
    }

    /**
     * @throws Throwable
     * @throws ConnectionException
     */
    public function getWalmartProductResult(
        string $job_id,
        bool $check_status = false,
        int $status_check_limit = 5,
        int $status_wait_seconds = 3,
        ?string $type = 'parsed',
    ): WalmartProductResponse {
        $response = $this->getPushPullResults($job_id, $check_status, $status_check_limit, $status_wait_seconds, $type);

        return WalmartProductResponse::from($response);
    }
}
