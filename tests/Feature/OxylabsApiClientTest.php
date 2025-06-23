<?php

namespace AlwaysOpen\OxylabsApi\Tests\Feature;

use AlwaysOpen\OxylabsApi\DTOs\AmazonPricingRequest;
use AlwaysOpen\OxylabsApi\DTOs\AmazonPricingResponse;
use AlwaysOpen\OxylabsApi\DTOs\AmazonProductRequest;
use AlwaysOpen\OxylabsApi\DTOs\AmazonSearchRequest;
use AlwaysOpen\OxylabsApi\DTOs\AmazonSearchResponse;
use AlwaysOpen\OxylabsApi\DTOs\AmazonSellersRequest;
use AlwaysOpen\OxylabsApi\DTOs\AmazonSellersResponse;
use AlwaysOpen\OxylabsApi\OxylabsApiClient;
use AlwaysOpen\OxylabsApi\Tests\BaseTest;
use Illuminate\Support\Facades\Http;

class OxylabsApiClientTest extends BaseTest
{
    public function test_amazon_product()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response($this->getFixtureJsonContent('push_pull_job.json'), 200),
            'data.oxylabs.io/v1/queries/7341123701204603905/results' => Http::response($this->getFixtureJsonContent('amazon_product_result.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $request = new AmazonProductRequest(
            source: 'amazon',
            domain: 'com',
            asin: 'B0000000'
        );

        $response = $client->amazonProduct($request);

        $this->assertEquals('7341123701204603905', $response->id);

        $result_response = $client->getAmazonProductResult($response->id);

        $this->assertEquals('7341123701204603905', $result_response->job->id);
        $this->assertCount(1, $result_response->results);
    }

    //    public function test_amazon_search()
    //    {
    //        Http::fake([
    //            'data.oxylabs.io/v1/queries' => Http::response(['test' => 'data'], 200),
    //        ]);
    //
    //        $client = new OxylabsApiClient(username: 'user', password: 'pass');
    //
    //        $request = new AmazonSearchRequest(
    //            source: 'amazon',
    //            domain: 'com',
    //            query: 'test'
    //        );
    //
    //        $response = $client->amazonSearch($request);
    //
    //        $this->assertInstanceOf(AmazonSearchResponse::class, $response);
    //        $this->assertEquals(['test' => 'data'], $response->data);
    //    }

    //    public function test_amazon_pricing()
    //    {
    //        Http::fake([
    //            'data.oxylabs.io/v1/queries' => Http::response(['test' => 'data'], 200),
    //        ]);
    //
    //        $client = new OxylabsApiClient(username: 'user', password: 'pass');
    //
    //        $request = new AmazonPricingRequest(
    //            source: 'amazon',
    //            domain: 'com',
    //            asin: 'B0000000'
    //        );
    //
    //        $response = $client->amazonPricing($request);
    //
    //        $this->assertInstanceOf(AmazonPricingResponse::class, $response);
    //        $this->assertEquals(['test' => 'data'], $response->data);
    //    }

    //    public function test_amazon_sellers()
    //    {
    //        Http::fake([
    //            'data.oxylabs.io/v1/queries' => Http::response(['test' => 'data'], 200),
    //        ]);
    //
    //        $client = new OxylabsApiClient(username: 'user', password: 'pass');
    //
    //        $request = new AmazonSellersRequest(
    //            source: 'amazon',
    //            domain: 'com',
    //            query: 'test'
    //        );
    //
    //        $response = $client->amazonSellers($request);
    //
    //        $this->assertInstanceOf(AmazonSellersResponse::class, $response);
    //        $this->assertEquals(['test' => 'data'], $response->data);
    //    }
}
