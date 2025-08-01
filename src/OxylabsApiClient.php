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
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class OxylabsApiClient
{
    protected string $baseUrl;

    protected string $username;

    protected string $password;

    protected string $authMethod;

    public function __construct(
        ?string $baseUrl = null,
        ?string $username = null,
        ?string $password = null,
        ?string $authMethod = null,
    ) {
        $this->baseUrl = rtrim($baseUrl ?? config('oxylabs-api.base_url', 'https://data.oxylabs.io/v1/'), '/');
        $this->username = $username ?? config('oxylabs-api.username') ?? '';
        $this->password = $password ?? config('oxylabs-api.password') ?? '';
        $this->authMethod = $authMethod ?? config('oxylabs-api.auth_method') ?? 'basic';
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
            default => throw new \InvalidArgumentException('Invalid authentication method')
        };
    }

    protected function getBaseRequest(): Factory|PendingRequest
    {
        return Http::withHeaders($this->getAuthHeader());
    }

    /**
     * @throws ConnectionException
     */
    protected function makeRequest(string $source, array $payload): PushPullJob
    {
        $response = $this->getBaseRequest()
            ->post($this->baseUrl.'/queries', [
                'source' => $source,
                ...$payload,
            ]);

        if (! $response->successful()) {
            throw new \RuntimeException('API request failed: '.$response->body());
        }

        return PushPullJob::from($response->json());
    }

    /**
     * @throws ConnectionException
     */
    public function getResult(
        string $job_id,
        ?string $type = null,
    ): null|array {
        $response = $this->getBaseRequest()
            ->get($this->baseUrl."/queries/$job_id/results".($type ? "?type=$type" : ''));

        if (! $response->successful()) {
            throw new \RuntimeException('API request failed: '.$response->body());
        }

        return $response->json();
    }

    public function getPushPullJob(string $job_id): PushPullJob
    {
        $response = $this->getBaseRequest()
            ->get($this->baseUrl."/queries/$job_id");

        if (! $response->successful()) {
            throw new \RuntimeException('API request failed: '.$response->body());
        }

        return PushPullJob::from($response->json());
    }

    /**
     * @throws ConnectionException
     */
    public function getPushPullResults(
        string $job_id,
        bool $check_status = false,
        int $status_check_limit = 5,
        int $status_wait_seconds = 3,
        ?string $type = null,
    ): array|null {
        if ($check_status) {
            $count = 0;
            do {
                $count++;
                $job = $this->getPushPullJob($job_id);
                if ($job->isPending()) {
                    sleep($status_wait_seconds);
                }
                // @TODO handle faulted status
            } while ($job->isPending() && $count < $status_check_limit);
        }

        return $this->getResult($job_id, $type);
    }

    /**
     * @throws ConnectionException
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
     * @throws ConnectionException
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
     * @throws ConnectionException
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
     * @throws ConnectionException
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
     * @throws ConnectionException
     */
    public function makeBatchRequest(BatchRequest $payload): PushPullBatchJobResponse
    {
        $response = $this->getBaseRequest()
            ->post($this->baseUrl.'/queries/batch', $payload->toArray());

        if (! $response->successful()) {
            throw new \RuntimeException('API request failed: '.$response->body());
        }

        return PushPullBatchJobResponse::from($response->json());
    }

    public function amazon(AmazonRequest $request): PushPullJob
    {
        return $this->makeRequest(OxylabsApi::TARGET_AMAZON, $request->toArray());
    }

    public function amazonProduct(AmazonProductRequest $request): PushPullJob
    {
        return $this->makeRequest(OxylabsApi::SOURCE_AMAZON_PRODUCT, $request->toArray());
    }

    public function amazonSearch(AmazonSearchRequest $request): PushPullJob
    {
        return $this->makeRequest(OxylabsApi::SOURCE_AMAZON_SEARCH, $request->toArray());
    }

    public function amazonPricing(AmazonPricingRequest $request): PushPullJob
    {
        return $this->makeRequest(OxylabsApi::SOURCE_AMAZON_PRICING, $request->toArray());
    }

    public function amazonSellers(AmazonSellersRequest $request): PushPullJob
    {
        return $this->makeRequest(OxylabsApi::SOURCE_AMAZON_SELLERS, $request->toArray());
    }

    public function googleSearch(GoogleSearchRequest $request): PushPullJob
    {
        return $this->makeRequest(OxylabsApi::SOURCE_GOOGLE_SHOPPING_SEARCH, $request->toArray());
    }

    public function universal(UniversalRequest $request): PushPullJob
    {
        return $this->makeRequest('universal', $request->toArray());
    }

    /**
     * @throws ConnectionException
     */
    public function googleShoppingProduct(GoogleShoppingProductRequest $request): PushPullJob
    {
        return $this->makeRequest(OxylabsApi::SOURCE_GOOGLE_SHOPPING_PRODUCT, $request->toArray());
    }

    /**
     * @throws ConnectionException
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
     * @throws ConnectionException
     */
    public function googleShoppingPricing(GoogleShoppingPricingRequest $request): PushPullJob
    {
        return $this->makeRequest(OxylabsApi::SOURCE_GOOGLE_SHOPPING_PRICING, $request->toArray());
    }

    /**
     * @throws ConnectionException
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
}
