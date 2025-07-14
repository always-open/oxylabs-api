<?php

namespace AlwaysOpen\OxylabsApi\Tests\Feature;

use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonPricingRequest;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonPricingResponse;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonProductRequest;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonSellersRequest;
use AlwaysOpen\OxylabsApi\DTOs\Google\GoogleShoppingProductRequest;
use AlwaysOpen\OxylabsApi\DTOs\Google\GoogleShoppingProductResponse;
use AlwaysOpen\OxylabsApi\DTOs\Google\GoogleShoppingPricingRequest;
use AlwaysOpen\OxylabsApi\DTOs\Google\GoogleShoppingPricingResponse;
use AlwaysOpen\OxylabsApi\OxylabsApiClient;
use AlwaysOpen\OxylabsApi\Tests\BaseTest;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class OxylabsApiClientTest extends BaseTest
{
    public function test_amazon_product()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response($this->getFixtureJsonContent('push_pull_job.json'), 200),
            'data.oxylabs.io/v1/queries/7342973874281147393/results/?type=parsed' => Http::response($this->getFixtureJsonContent('amazon_product_result.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $request = new AmazonProductRequest(
            source: 'amazon',
            domain: 'com',
            asin: 'B0000000'
        );

        $response = $client->amazonProduct($request);

        $this->assertEquals('7342973874281147393', $response->id);

        $result_response = $client->getAmazonProductResult($response->id);

        $this->assertEquals('7342973874281147393', $result_response->job->id);
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

    public function test_amazon_pricing()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response($this->getFixtureJsonContent('push_pull_job.json'), 200),
            'data.oxylabs.io/v1/queries/7342973874281147393/results/?type=parsed' => Http::response($this->getFixtureJsonContent('amazon_pricing_results.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $request = new AmazonPricingRequest(
            source: 'amazon',
            domain: 'com',
            asin: 'B0000000'
        );

        $response = $client->amazonPricing($request);
        $result = $client->getAmazonPricingResult($response->id);

        $this->assertInstanceOf(AmazonPricingResponse::class, $result);
        $this->assertEquals(328.95, $result->results[0]->content->pricing[0]->price);
    }

    /**
     * @throws ConnectionException
     */
    public function test_amazon_sellers()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response($this->getFixtureJsonContent('push_pull_job.json'), 200),
            'data.oxylabs.io/v1/queries/7342973874281147393/results/?type=parsed' => Http::response($this->getFixtureJsonContent('amazon_seller_results.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $request = new AmazonSellersRequest(
            source: 'amazon_seller',
            query: 'test'
        );

        $response = $client->amazonSellers($request);

        $result = $client->getAmazonSellerResult($response->id);

        $this->assertEquals(44, $result->results[0]->content->feedback_summary_table->counts->_30_days);
        $this->assertEquals('100%', $result->results[0]->content->feedback_summary_data->_1_month->_1_star);
    }

    public function test_google_shopping_product()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response($this->getFixtureJsonContent('push_pull_job.json'), 200),
            'data.oxylabs.io/v1/queries/7342973874281147393/results/?type=parsed' => Http::response($this->getFixtureJsonContent('google_shopping_product_result.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $request = new GoogleShoppingProductRequest(
            source: 'google_shopping_product',
            domain: 'com',
            query: '9643822540334825608'
        );

        $response = $client->googleShoppingProduct($request);

        $this->assertEquals('7342973874281147393', $response->id);

        $result = $client->getGoogleShoppingProductResult($response->id);

        $this->assertInstanceOf(GoogleShoppingProductResponse::class, $result);
        $this->assertEquals('7342973874281147393', $result->job->id);
        $this->assertCount(1, $result->results);
        $this->assertEquals('Adidas Samba OG Black/White for Kids IE3676 - 6', $result->results[0]->content->title);
        $this->assertEquals(80, $result->results[0]->content->pricing->online[0]->price);
    }

    public function test_google_shopping_pricing()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response($this->getFixtureJsonContent('push_pull_job.json'), 200),
            'data.oxylabs.io/v1/queries/7342973874281147393/results/?type=parsed' => Http::response($this->getFixtureJsonContent('google_shopping_pricing_result.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $request = new GoogleShoppingPricingRequest(
            source: 'google_shopping_pricing',
            domain: 'com',
            query: '9643822540334825608'
        );

        $response = $client->googleShoppingPricing($request);

        $this->assertEquals('7342973874281147393', $response->id);

        $result = $client->getGoogleShoppingPricingResult($response->id);

        $this->assertInstanceOf(GoogleShoppingPricingResponse::class, $result);
        $this->assertEquals('7342973874281147393', $result->job->id);
        $this->assertCount(1, $result->results);
        $this->assertEquals('Adidas Samba OG Black/White for Kids IE3676 - 6', $result->results[0]->content->title);
        $this->assertEquals(80, $result->results[0]->content->pricing[0]->price);
    }
}
