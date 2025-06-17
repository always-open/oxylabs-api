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
use AlwaysOpen\OxylabsApi\DTOs\GoogleSearchRequest;
use AlwaysOpen\OxylabsApi\DTOs\GoogleSearchResponse;
use AlwaysOpen\OxylabsApi\DTOs\UniversalRequest;
use AlwaysOpen\OxylabsApi\DTOs\UniversalResponse;
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
        $this->baseUrl = rtrim($baseUrl ?? config('oxylabs-api.base_url', 'https://data.oxylabs.io/v1/querieshttps://realtime.oxylabs.io/v1'), '/');
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

    protected function makeRequest(string $source, array $payload): array
    {
        $response = Http::withHeaders($this->getAuthHeader())
            ->post($this->baseUrl.'/queries', [
                'source' => $source,
                ...$payload,
            ]);

        if (! $response->successful()) {
            throw new \RuntimeException('API request failed: '.$response->body());
        }

        return $response->json();
    }

    public function amazonProduct(AmazonProductRequest $request): AmazonProductResponse
    {
        $response = $this->makeRequest('amazon_product', $request->toArray());

        return AmazonProductResponse::fromArray($response);
    }

    public function amazonSearch(AmazonSearchRequest $request): AmazonSearchResponse
    {
        $response = $this->makeRequest('amazon_search', $request->toArray());

        return AmazonSearchResponse::fromArray($response);
    }

    public function amazonPricing(AmazonPricingRequest $request): AmazonPricingResponse
    {
        $response = $this->makeRequest('amazon_pricing', $request->toArray());

        return AmazonPricingResponse::fromArray($response);
    }

    public function amazonSellers(AmazonSellersRequest $request): AmazonSellersResponse
    {
        $response = $this->makeRequest('amazon_sellers', $request->toArray());

        return AmazonSellersResponse::fromArray($response);
    }

    public function googleSearch(GoogleSearchRequest $request): GoogleSearchResponse
    {
        $response = $this->makeRequest('google_search', $request->toArray());

        return GoogleSearchResponse::fromArray($response);
    }

    public function universal(UniversalRequest $request): UniversalResponse
    {
        $response = $this->makeRequest('universal', $request->toArray());

        return UniversalResponse::fromArray($response);
    }
}
