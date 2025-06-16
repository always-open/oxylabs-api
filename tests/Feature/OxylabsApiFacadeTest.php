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
use AlwaysOpen\OxylabsApi\OxylabsApiFacade;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase;

class OxylabsApiFacadeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
    }

    public function test_amazon_product()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response(['test' => 'data'], 200),
        ]);

        $request = new AmazonProductRequest(
            source: 'amazon',
            domain: 'com',
            asin: 'B0000000'
        );

        $response = OxylabsApiFacade::amazonProduct($request);

        $this->assertInstanceOf(AmazonProductResponse::class, $response);
        $this->assertEquals(['test' => 'data'], $response->data);
    }

    public function test_amazon_search()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response(['test' => 'data'], 200),
        ]);

        $request = new AmazonSearchRequest(
            source: 'amazon',
            domain: 'com',
            query: 'test'
        );

        $response = OxylabsApiFacade::amazonSearch($request);

        $this->assertInstanceOf(AmazonSearchResponse::class, $response);
        $this->assertEquals(['test' => 'data'], $response->data);
    }

    public function test_amazon_pricing()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response(['test' => 'data'], 200),
        ]);

        $request = new AmazonPricingRequest(
            source: 'amazon',
            domain: 'com',
            asin: 'B0000000'
        );

        $response = OxylabsApiFacade::amazonPricing($request);

        $this->assertInstanceOf(AmazonPricingResponse::class, $response);
        $this->assertEquals(['test' => 'data'], $response->data);
    }

    public function test_amazon_sellers()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response(['test' => 'data'], 200),
        ]);

        $request = new AmazonSellersRequest(
            source: 'amazon',
            domain: 'com',
            query: 'test'
        );

        $response = OxylabsApiFacade::amazonSellers($request);

        $this->assertInstanceOf(AmazonSellersResponse::class, $response);
        $this->assertEquals(['test' => 'data'], $response->data);
    }
}
