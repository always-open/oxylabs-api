<?php

namespace AlwaysOpen\OxylabsApi;

use AlwaysOpen\OxylabsApi\DTOs\AmazonPricingRequest;
use AlwaysOpen\OxylabsApi\DTOs\AmazonPricingResponse;
use AlwaysOpen\OxylabsApi\DTOs\AmazonProductRequest;
use AlwaysOpen\OxylabsApi\DTOs\AmazonProductResponse;
use AlwaysOpen\OxylabsApi\DTOs\AmazonSearchRequest;
use AlwaysOpen\OxylabsApi\DTOs\AmazonSearchResponse;
use AlwaysOpen\OxylabsApi\DTOs\AmazonSellersRequest;
use AlwaysOpen\OxylabsApi\DTOs\AmazonSellersResponse;
use AlwaysOpen\OxylabsApi\DTOs\BatchRequest;
use AlwaysOpen\OxylabsApi\DTOs\GoogleSearchRequest;
use AlwaysOpen\OxylabsApi\DTOs\GoogleSearchResponse;
use AlwaysOpen\OxylabsApi\DTOs\PushPullBatchJobResponse;
use AlwaysOpen\OxylabsApi\DTOs\PushPullJob;
use AlwaysOpen\OxylabsApi\DTOs\PushPullJobResponse;
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
    )
    {
        $this->baseUrl = rtrim($baseUrl ?? config('oxylabs-api.base_url', 'https://data.oxylabs.io/v1/'), '/');
        $this->username = $username ?? config('oxylabs-api.username') ?? '';
        $this->password = $password ?? config('oxylabs-api.password') ?? '';
        $this->authMethod = $authMethod ?? config('oxylabs-api.auth_method') ?? 'basic';
    }

    protected function getAuthHeader(): array
    {
        return match ($this->authMethod) {
            'basic' => [
                'Authorization' => 'Basic ' . base64_encode($this->username . ':' . $this->password),
            ],
            'bearer' => [
                'Authorization' => 'Bearer ' . $this->password,
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
            ->post($this->baseUrl . '/queries', [
                'source' => $source,
                ...$payload,
            ]);

        if (!$response->successful()) {
            throw new \RuntimeException('API request failed: ' . $response->body());
        }

        return PushPullJob::from($response->json());
    }

    /**
     * @throws ConnectionException
     */
    public function getResult(string $job_id): array
    {
        $response = $this->getBaseRequest()
            ->get($this->baseUrl . "/queries/$job_id/results");

        if (!$response->successful()) {
            throw new \RuntimeException('API request failed: ' . $response->body());
        }

        return $response->json();
    }

    /**
     * @throws ConnectionException
     */
    public function getAmazonProductResult(string $job_id): AmazonProductResponse
    {
        $response = $this->getResult($job_id);

        return AmazonProductResponse::from($response);
    }

    public function getPushPullJob(string $job_id): PushPullJob
    {
        $response = $this->getBaseRequest()
            ->get($this->baseUrl . "/queries/$job_id");

        if (!$response->successful()) {
            throw new \RuntimeException('API request failed: ' . $response->body());
        }

        return PushPullJob::from($response->json());
    }

    public function getPushPullResults(
        string  $job_id,
        bool    $check_status = false,
        int     $status_check_limit = 5,
        int     $status_wait_seconds = 3,
        ?string $type = null
    ): array
    {
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

        $response = $this->getBaseRequest()
            ->get($this->baseUrl . "/queries/$job_id/results" . ($type ? "/?type=$type" : ""));

        if (!$response->successful()) {
            throw new \RuntimeException('API request failed: ' . $response->body());
        }

        return $response->json();
    }

    public function getAmazonProductResults(
        string $job_id,
        bool   $check_status = false,
        int    $status_check_limit = 5,
        int    $status_wait_seconds = 3,
    ): AmazonProductResponse
    {
        $response = $this->getPushPullResults($job_id, $check_status, $status_check_limit, $status_wait_seconds, 'parsed');

        return AmazonProductResponse::from($response);
    }

    /**
     * @throws ConnectionException
     */
    public function makeBatchRequest(BatchRequest $payload): PushPullBatchJobResponse
    {
        $response = $this->getBaseRequest()
            ->post($this->baseUrl . '/queries/batch', $payload->toArray());

        if (!$response->successful()) {
            throw new \RuntimeException('API request failed: ' . $response->body());
        }

        return PushPullBatchJobResponse::from($response->json());
    }

    public function amazonProduct(AmazonProductRequest $request): PushPullJob
    {
        return $this->makeRequest('amazon_product', $request->toArray());
    }

    public function amazonSearch(AmazonSearchRequest $request): PushPullJob
    {
        return $this->makeRequest('amazon_search', $request->toArray());
    }

    public function amazonPricing(AmazonPricingRequest $request): PushPullJob
    {
        return $this->makeRequest('amazon_pricing', $request->toArray());
    }

    public function amazonSellers(AmazonSellersRequest $request): PushPullJob
    {
        return $this->makeRequest('amazon_sellers', $request->toArray());
    }

    public function googleSearch(GoogleSearchRequest $request): PushPullJob
    {
        return $this->makeRequest('google_search', $request->toArray());
    }

    public function universal(UniversalRequest $request): PushPullJob
    {
        return $this->makeRequest('universal', $request->toArray());
    }
}
