<?php

namespace AlwaysOpen\OxylabsApi\Tests\Feature;

use AlwaysOpen\OxylabsApi\DTOs\AmazonPricingRequest;
use AlwaysOpen\OxylabsApi\DTOs\AmazonPricingResponse;
use AlwaysOpen\OxylabsApi\DTOs\AmazonProductRequest;
use AlwaysOpen\OxylabsApi\DTOs\AmazonSearchRequest;
use AlwaysOpen\OxylabsApi\DTOs\AmazonSearchResponse;
use AlwaysOpen\OxylabsApi\DTOs\AmazonSellersRequest;
use AlwaysOpen\OxylabsApi\OxylabsApiFacade;
use AlwaysOpen\OxylabsApi\Tests\BaseTest;
use Illuminate\Support\Facades\Http;

class OxylabsApiFacadeTest extends BaseTest
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
    }

    public function test_amazon_product()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response($this->getFixtureJsonContent('push_pull_job.json'), 200),
            'data.oxylabs.io/v1/queries/7342973874281147393/results' => Http::response($this->getFixtureJsonContent('amazon_product_result.json'), 200),
        ]);

        $request = new AmazonProductRequest(
            source: 'amazon',
            domain: 'com',
            asin: 'B0000000'
        );

        $response = OxylabsApiFacade::amazonProduct($request);

        $this->assertEquals('7342973874281147393', $response->id);

        $result_response = OxylabsApiFacade::getAmazonProductResult($response->id);

        $this->assertEquals('7342973874281147393', $result_response->job->id);
        $this->assertCount(1, $result_response->results);
    }

    //    public function test_amazon_search()
    //    {
    //        Http::fake([
    //            'data.oxylabs.io/v1/queries' => Http::response(['test' => 'data'], 200),
    //        ]);
    //
    //        $request = new AmazonSearchRequest(
    //            source: 'amazon',
    //            domain: 'com',
    //            query: 'test'
    //        );
    //
    //        $response = OxylabsApiFacade::amazonSearch($request);
    //
    //        $this->assertInstanceOf(AmazonSearchResponse::class, $response);
    //        $this->assertEquals(['test' => 'data'], $response->data);
    //    }
    //
    //    public function test_amazon_pricing()
    //    {
    //        Http::fake([
    //            'data.oxylabs.io/v1/queries' => Http::response(['test' => 'data'], 200),
    //        ]);
    //
    //        $request = new AmazonPricingRequest(
    //            source: 'amazon',
    //            domain: 'com',
    //            asin: 'B0000000'
    //        );
    //
    //        $response = OxylabsApiFacade::amazonPricing($request);
    //
    //        $this->assertInstanceOf(AmazonPricingResponse::class, $response);
    //        $this->assertEquals(['test' => 'data'], $response->data);
    //    }
    //
    //    public function test_amazon_sellers()
    //    {
    //        Http::fake([
    //            'data.oxylabs.io/v1/queries' => Http::response(['test' => 'data'], 200),
    //        ]);
    //
    //        $request = new AmazonSellersRequest(
    //            source: 'amazon',
    //            domain: 'com',
    //            query: 'test'
    //        );
    //
    //        $response = OxylabsApiFacade::amazonSellers($request);
    //
    //        $this->assertInstanceOf(AmazonSellersResponse::class, $response);
    //        $this->assertEquals(['test' => 'data'], $response->data);
    //    }
}
