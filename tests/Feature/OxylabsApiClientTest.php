<?php

namespace AlwaysOpen\OxylabsApi\Tests\Feature;

use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonPricingRequest;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonProductRequest;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonRequest;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonSellersRequest;
use AlwaysOpen\OxylabsApi\DTOs\Google\GoogleShoppingPricingRequest;
use AlwaysOpen\OxylabsApi\DTOs\Google\GoogleShoppingProductRequest;
use AlwaysOpen\OxylabsApi\DTOs\Google\Url\GoogleUrlRequest;
use AlwaysOpen\OxylabsApi\DTOs\Walmart\WalmartProductRequest;
use AlwaysOpen\OxylabsApi\Enums\ParseStatus;
use AlwaysOpen\OxylabsApi\Enums\RenderOption;
use AlwaysOpen\OxylabsApi\OxylabsApi;
use AlwaysOpen\OxylabsApi\OxylabsApiClient;
use AlwaysOpen\OxylabsApi\Tests\BaseTest;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class OxylabsApiClientTest extends BaseTest
{
    protected function setUp(): void
    {
        parent::setUp();
        Config::set('oxylabs-api.request_logging_enabled', false);
    }

    public function test_amazon_product()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response($this->getFixtureJsonContent('push_pull_job.json'), 200),
            'data.oxylabs.io/v1/queries/7342973874281147393/results?type=parsed' => Http::response($this->getFixtureJsonContent('amazon_product_result.json'), 200),
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

    public function test_amazon_product_faulted()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries/7342973874281147393/results?type=parsed' => Http::response($this->getFixtureJsonContent('amazon_product_listing_faulted.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');
        $result_response = $client->getAmazonProductResult('7342973874281147393');

        $this->assertCount(1, $result_response->results);
        $this->assertNotEquals(ParseStatus::SUCCESS->value, $result_response->results[0]->content->parse_status_code);
        $this->assertEquals('faulted', $result_response->job->status);
    }

    public function test_amazon_pricing_faulted()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries/7342973874281147394/results?type=parsed' => Http::response($this->getFixtureJsonContent('amazon_product_listing_faulted2.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $result_response = $client->getAmazonPricingResult('7342973874281147394');

        $this->assertCount(1, $result_response->results);
        $this->assertEmpty($result_response->results[0]->content);
        $this->assertEquals('faulted', $result_response->job->status);
    }

    public function test_google_shopping_faulted()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries/7342973874281147393/results?type=parsed' => Http::response($this->getFixtureJsonContent('google_shopping_faulted_result.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');
        $result_response = $client->getGoogleShoppingPricingResult('7342973874281147393');

        $this->assertCount(1, $result_response->results);
        $this->assertEmpty($result_response->results[0]->content);
        $this->assertEquals('faulted', $result_response->job->status);
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
            'data.oxylabs.io/v1/queries/7342973874281147393/results?type=parsed' => Http::response($this->getFixtureJsonContent('amazon_pricing_results.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $request = new AmazonPricingRequest(
            source: 'amazon',
            domain: 'com',
            asin: 'B0000000'
        );

        $response = $client->amazonPricing($request);
        $result = $client->getAmazonPricingResult($response->id);

        $this->assertEquals(328.95, $result->results[0]->content->pricing[0]->price);
    }

    public function test_amazon_pricing_no_available_listings()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response($this->getFixtureJsonContent('push_pull_job.json'), 200),
            'data.oxylabs.io/v1/queries/7342973874281147393/results?type=parsed' => Http::response($this->getFixtureJsonContent('amazon_pricing_cannot_parse.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $result = $client->getAmazonPricingResult('7342973874281147393');

        $this->assertNotEmpty($result->results[0]->content->_warnings);
    }

    /**
     * @throws ConnectionException
     */
    public function test_amazon_sellers()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response($this->getFixtureJsonContent('push_pull_job.json'), 200),
            'data.oxylabs.io/v1/queries/7342973874281147393/results?type=parsed' => Http::response($this->getFixtureJsonContent('amazon_seller_results.json'), 200),
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
            'data.oxylabs.io/v1/queries/7342973874281147393/results?type=parsed' => Http::response($this->getFixtureJsonContent('google_shopping_product_result.json'), 200),
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

        $this->assertCount(1, $result->results);
        $this->assertEquals('Adidas Samba OG Black/White for Kids IE3676 - 6', $result->results[0]->content->title);
        $this->assertEquals(80, $result->results[0]->content->pricing->online[0]->price);
    }

    public function test_google_shopping_pricing_not_found()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries/7342973874281147393/results?type=parsed' => Http::response($this->getFixtureJsonContent('google_shopping_not_found.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $result = $client->getGoogleShoppingPricingResult('7342973874281147393');

        $this->assertCount(1, $result->results);
        $this->assertEquals(ParseStatus::FAILURE_PRODUCT_NOT_FOUND->value, $result->results[0]->content->parse_status_code);
    }

    public function test_google_shopping_pricing()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response($this->getFixtureJsonContent('push_pull_job.json'), 200),
            'data.oxylabs.io/v1/queries/7342973874281147393/results?type=parsed' => Http::response($this->getFixtureJsonContent('google_shopping_pricing_result.json'), 200),
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

        $this->assertCount(1, $result->results);
        $this->assertEquals('Adidas Samba OG Black/White for Kids IE3676 - 6', $result->results[0]->content->title);
        $this->assertEquals(80, $result->results[0]->content->pricing[0]->price);
    }

    public function test_walmart_product()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response($this->getFixtureJsonContent('push_pull_job.json'), 200),
            'data.oxylabs.io/v1/queries/7342973874281147393/results?type=parsed' => Http::response($this->getFixtureJsonContent('walmart_product_results.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $request = new WalmartProductRequest(
            source: 'walmart_product',
            domain: 'com',
            product_id: '123456'
        );

        $response = $client->walmartProduct($request);

        $result = $client->getWalmartProductResult($response->id);

        $this->assertCount(1, $result->results);
    }

    public function test_walmart_product_raw()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries/7342973874281147393/results?type=raw' => Http::response($this->getFixtureJsonContent('walmart_raw_result.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $result = $client->getWalmartProductResult('7342973874281147393', type: 'raw');

        $this->assertIsString($result->results[0]->content);
    }

    public function test_walmart_screenshot()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response($this->getFixtureJsonContent('push_pull_job.json'), 200),
            'data.oxylabs.io/v1/queries/7350883412053343233/results?type=png' => Http::response($this->getFixtureJsonContent('walmart_product_screenshot.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $request = new WalmartProductRequest(
            source: 'walmart_product',
            domain: 'com',
            product_id: '123456',
            render: RenderOption::PNG,
        );

        $client->walmartProduct($request);

        $result = $client->getWalmartProductResult('7350883412053343233', type: 'png');

        $this->assertTrue($result->results[0]->isRaw());
        $saved = $result->results[0]->saveImageTo(__DIR__.'/7350883412053343233_walmart.png');
        $this->assertTrue($saved);
    }

    public function test_google_url()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response($this->getFixtureJsonContent('push_pull_job.json'), 200),
            'data.oxylabs.io/v1/queries/7350883412053343233/results?type=html' => Http::response($this->getFixtureJsonContent('google_url_results.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $request = new GoogleUrlRequest(
            source: OxylabsApi::TARGET_GOOGLE,
            domain: 'com',
            query: '123456',
            render: RenderOption::HTML,
        );

        $client->googleUrl($request);

        $result = $client->getGoogleUrlResult('7350883412053343233', type: 'html');

        $this->assertTrue($result->results[0]->isRaw());
    }

    public function test_amazon_screenshot()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response($this->getFixtureJsonContent('push_pull_job.json'), 200),
            'data.oxylabs.io/v1/queries/7350883412053343233/results?type=png' => Http::response($this->getFixtureJsonContent('amazon_pricing_png_result.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $request = new AmazonPricingRequest(
            source: OxylabsApi::SOURCE_AMAZON_PRICING,
            domain: 'com',
            asin: 'testing',
            render: RenderOption::PNG,
        );

        $client->amazonPricing($request);

        $result = $client->getAmazonPricingResult('7350883412053343233', type: 'png');

        $this->assertTrue($result->results[0]->isRaw());
        $saved = $result->results[0]->saveImageTo(__DIR__.'/7350883412053343233.png');
        $this->assertTrue($saved);
    }

    public function test_amazon_request_parsed()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries/7350883412053343233/results?type=parsed' => Http::response($this->getFixtureJsonContent('amazon_response_parse.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $result = $client->getAmazonResult('7350883412053343233', type: 'parsed');

        $this->assertFalse($result->results[0]->isRaw());
        $saved = $result->results[0]->saveImageTo(__DIR__.'/7350883412053343233.png');
        $this->assertFalse($saved);
    }

    public function test_amazon_request_not_parsed()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries' => Http::response($this->getFixtureJsonContent('push_pull_job.json'), 200),
            'data.oxylabs.io/v1/queries/7350883412053343233/results?type=html' => Http::response($this->getFixtureJsonContent('amazon_response_no_parse.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $amazonUrl = AmazonRequest::generateUrl(
            asin: 'B07WWYQS7B',
            sellerId: 'A3I4UNTI7XY11E',
        );

        $this->assertEquals(
            'https://www.amazon.com/dp/B07WWYQS7B/ref=sr_1_4?m=A3I4UNTI7XY11E&s=merchant-items&sr=1-4&th=1&psc=1',
            $amazonUrl,
        );

        $request = new AmazonRequest(
            source: OxylabsApi::TARGET_AMAZON,
            domain: 'com',
            url: $amazonUrl,
        );

        $client->amazon($request);
        $result = $client->getAmazonResult('7350883412053343233', type: 'html');

        $this->assertTrue($result->results[0]->isRaw());
        $saved = $result->results[0]->saveImageTo(__DIR__.'/7350883412053343233.png');
        $this->assertTrue($saved);
    }

    public function test_universal_request()
    {
        Http::fake([
            'data.oxylabs.io/v1/queries/7350883412053343233/results?type=raw' => Http::response($this->getFixtureJsonContent('universal_result.json'), 200),
            'data.oxylabs.io/v1/queries/7350883412053343234/results?type=raw' => Http::response($this->getFixtureJsonContent('universal_failed_result.json'), 200),
        ]);

        $client = new OxylabsApiClient(username: 'user', password: 'pass');

        $result = $client->getUniversalResult('7350883412053343233');

        $this->assertEmpty($result->results[0]->_response->cookies[0]->max_age);

        $result = $client->getUniversalResult('7350883412053343234');

        $this->assertEquals(ParseStatus::FAILURE_COULD_NOT_PARSE->value, $result->results[0]->content->parse_status_code);
    }
}
