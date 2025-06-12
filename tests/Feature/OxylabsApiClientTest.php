<?php

namespace AlwaysOpen\OxylabsApi\Tests\Feature;

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
use AlwaysOpen\OxylabsApi\OxylabsApiClient;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase;

class OxylabsApiClientTest extends TestCase
{
    public function test_amazon_product()
    {
        Http::fake([
            'api.oxylabs.io/v1/amazon/product' => Http::response(['test' => 'data'], 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $request = new AmazonProductRequest(
            source: 'amazon',
            domain: 'com',
            asin: 'B0000000'
        );

        $response = $client->amazonProduct($request);

        $this->assertInstanceOf(AmazonProductResponse::class, $response);
        $this->assertEquals(['test' => 'data'], $response->data);
    }

    public function test_amazon_search()
    {
        Http::fake([
            'api.oxylabs.io/v1/amazon/search' => Http::response(['test' => 'data'], 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $request = new AmazonSearchRequest(
            source: 'amazon',
            domain: 'com',
            query: 'test'
        );

        $response = $client->amazonSearch($request);

        $this->assertInstanceOf(AmazonSearchResponse::class, $response);
        $this->assertEquals(['test' => 'data'], $response->data);
    }

    public function test_amazon_pricing()
    {
        Http::fake([
            'api.oxylabs.io/v1/amazon/pricing' => Http::response(['test' => 'data'], 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $request = new AmazonPricingRequest(
            source: 'amazon',
            domain: 'com',
            asin: 'B0000000'
        );

        $response = $client->amazonPricing($request);

        $this->assertInstanceOf(AmazonPricingResponse::class, $response);
        $this->assertEquals(['test' => 'data'], $response->data);
    }

    public function test_amazon_sellers()
    {
        Http::fake([
            'api.oxylabs.io/v1/amazon/sellers' => Http::response(['test' => 'data'], 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $request = new AmazonSellersRequest(
            source: 'amazon',
            domain: 'com',
            query: 'test'
        );

        $response = $client->amazonSellers($request);

        $this->assertInstanceOf(AmazonSellersResponse::class, $response);
        $this->assertEquals(['test' => 'data'], $response->data);
    }

    public function test_target_urls()
    {
        Http::fake([
            'api.oxylabs.io/v1/target/urls' => Http::response(['test' => 'data'], 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $request = new TargetUrlsRequest(
            source: 'universal',
            domain: 'com',
            url: 'https://example.com'
        );

        $response = $client->targetUrls($request);

        $this->assertInstanceOf(TargetUrlsResponse::class, $response);
        $this->assertEquals(['test' => 'data'], $response->data);
    }

    public function test_showcase()
    {
        Http::fake([
            'api.oxylabs.io/v1/showcase' => Http::response(['test' => 'data'], 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $request = new ShowcaseRequest(
            source: 'universal',
            url: 'https://example.com'
        );

        $response = $client->showcase($request);

        $this->assertInstanceOf(ShowcaseResponse::class, $response);
        $this->assertEquals(['test' => 'data'], $response->data);
    }
}
