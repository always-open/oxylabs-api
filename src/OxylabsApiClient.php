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
use AlwaysOpen\OxylabsApi\DTOs\ShowcaseRequest;
use AlwaysOpen\OxylabsApi\DTOs\ShowcaseResponse;
use AlwaysOpen\OxylabsApi\DTOs\TargetUrlsRequest;
use AlwaysOpen\OxylabsApi\DTOs\TargetUrlsResponse;
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
        $this->baseUrl = rtrim($baseUrl ?? config('oxylabs-api.base_url'), '/');
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

    public function amazonProduct(AmazonProductRequest $request): AmazonProductResponse
    {
        $response = Http::withHeaders($this->getAuthHeader())
            ->post($this->baseUrl . '/amazon/product', $request->toArray());

        return AmazonProductResponse::fromArray($response->json());
    }

    public function amazonSearch(AmazonSearchRequest $request): AmazonSearchResponse
    {
        $response = Http::withHeaders($this->getAuthHeader())
            ->post($this->baseUrl . '/amazon/search', $request->toArray());

        return AmazonSearchResponse::fromArray($response->json());
    }

    public function amazonPricing(AmazonPricingRequest $request): AmazonPricingResponse
    {
        $response = Http::withHeaders($this->getAuthHeader())
            ->post($this->baseUrl . '/amazon/pricing', $request->toArray());

        return AmazonPricingResponse::fromArray($response->json());
    }

    public function amazonSellers(AmazonSellersRequest $request): AmazonSellersResponse
    {
        $response = Http::withHeaders($this->getAuthHeader())
            ->post($this->baseUrl . '/amazon/sellers', $request->toArray());

        return AmazonSellersResponse::fromArray($response->json());
    }

    public function targetUrls(TargetUrlsRequest $request): TargetUrlsResponse
    {
        $response = Http::withHeaders($this->getAuthHeader())
            ->post($this->baseUrl . '/target/urls', $request->toArray());

        return TargetUrlsResponse::fromArray($response->json());
    }

    public function showcase(ShowcaseRequest $request): ShowcaseResponse
    {
        $response = Http::withHeaders($this->getAuthHeader())
            ->post($this->baseUrl . '/showcase', $request->toArray());

        return ShowcaseResponse::fromArray($response->json());
    }
}
