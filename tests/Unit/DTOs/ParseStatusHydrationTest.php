<?php

namespace AlwaysOpen\OxylabsApi\Tests\Unit\DTOs;

use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonProductResponse;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonProductResult;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonProductResultContent;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonResponse;
use AlwaysOpen\OxylabsApi\DTOs\Google\GoogleShoppingPricingResultContent;
use AlwaysOpen\OxylabsApi\DTOs\Google\GoogleShoppingProductResultContent;
use AlwaysOpen\OxylabsApi\DTOs\Walmart\WalmartProductResultContent;
use AlwaysOpen\OxylabsApi\Enums\ParseStatus;
use AlwaysOpen\OxylabsApi\Tests\BaseTest;

class ParseStatusHydrationTest extends BaseTest
{
    public function test_content_without_parse_status_code_hydrates_instead_of_throwing(): void
    {
        $response = AmazonProductResponse::from(
            $this->getFixtureJsonContent('amazon_product_missing_parse_status.json')
        );

        $content = $response->results[0]->content;

        $this->assertInstanceOf(AmazonProductResultContent::class, $content);
        $this->assertIsNotArray($content);
        $this->assertSame('B0846G5N74', $content->asin);
        $this->assertNull($content->parse_status_code);
    }

    public function test_result_hydrates_when_parser_type_is_absent(): void
    {
        // Oxylabs drops `parser_type` entirely on some unparsed responses
        // (see tests/Fixtures/amazon_response_no_parse.json). AmazonResult
        // already tolerated that; AmazonProductResult did not.
        $result = AmazonProductResult::from([
            'content' => ['asin' => 'B0846G5N74'],
            'page' => 1,
            'url' => 'https://www.amazon.com/dp/B0846G5N74',
            'job_id' => '7362153370909442049',
            'is_render_forced' => false,
            'status_code' => 200,
        ]);

        $this->assertNull($result->parser_type);
        $this->assertInstanceOf(AmazonProductResultContent::class, $result->content);
    }

    public function test_absent_parse_status_is_not_reported_and_not_success(): void
    {
        $response = AmazonProductResponse::from(
            $this->getFixtureJsonContent('amazon_product_missing_parse_status.json')
        );

        $content = $response->results[0]->content;

        $this->assertFalse($content->hasParseStatus());
        $this->assertSame(ParseStatus::NOT_REPORTED, $content->getParseStatusCode());
        $this->assertFalse($content->success());
    }

    public function test_empty_content_object_hydrates_to_all_nulls(): void
    {
        $content = AmazonProductResultContent::from([]);

        $this->assertInstanceOf(AmazonProductResultContent::class, $content);
        $this->assertNull($content->parse_status_code);
        $this->assertNull($content->title);
        $this->assertFalse($content->success());
    }

    public function test_unmodelled_parse_status_code_degrades_to_unknown_without_throwing(): void
    {
        $content = AmazonProductResultContent::from(['parse_status_code' => 12001]);

        $this->assertSame(12001, $content->parse_status_code);
        $this->assertTrue($content->hasParseStatus());
        $this->assertSame(ParseStatus::UNKNOWN, $content->getParseStatusCode());
        $this->assertFalse($content->success());
    }

    public function test_reported_success_status_is_unchanged(): void
    {
        $response = AmazonProductResponse::from(
            $this->getFixtureJsonContent('amazon_product_result.json')
        );

        $content = $response->results[0]->content;

        $this->assertSame(ParseStatus::SUCCESS->value, $content->parse_status_code);
        $this->assertTrue($content->hasParseStatus());
        $this->assertSame(ParseStatus::SUCCESS, $content->getParseStatusCode());
        $this->assertTrue($content->success());
    }

    public function test_reported_not_supported_status_still_classifies(): void
    {
        $response = AmazonProductResponse::from(
            $this->getFixtureJsonContent('amazon_product_listing_faulted.json')
        );

        $content = $response->results[0]->content;

        $this->assertSame(ParseStatus::NOT_SUPPORTED, $content->getParseStatusCode());
        $this->assertTrue($content->hasParseStatus());
    }

    public function test_raw_html_string_content_stays_a_string(): void
    {
        $response = AmazonResponse::from(
            $this->getFixtureJsonContent('amazon_response_no_parse.json')
        );

        $this->assertIsString($response->results[0]->content);
    }

    public function test_empty_string_content_stays_a_string(): void
    {
        $response = AmazonProductResponse::from(
            $this->getFixtureJsonContent('amazon_product_listing_faulted2.json')
        );

        $this->assertSame('', $response->results[0]->content);
    }

    public function test_amazon_product_result_still_accepts_string_content(): void
    {
        $result = AmazonProductResult::from([
            'content' => '<html>blocked</html>',
            'page' => 1,
            'url' => 'https://www.amazon.com/dp/B0846G5N74',
            'job_id' => '7362153370909442049',
            'is_render_forced' => false,
            'status_code' => 200,
            'parser_type' => '',
        ]);

        $this->assertIsString($result->content);
    }

    public function test_json_object_string_content_now_hydrates_to_content_object(): void
    {
        // Documented behaviour change: a *string* holding JSON object/array syntax
        // used to fall through the union to string; now every array-shaped payload
        // satisfies the content DTO, so it hydrates. Oxylabs does not emit this
        // shape today - this test pins the decision so it is not rediscovered.
        $result = AmazonProductResult::from([
            'content' => '{"asin":"B0846G5N74"}',
            'page' => 1,
            'url' => 'https://www.amazon.com/dp/B0846G5N74',
            'job_id' => '7362153370909442049',
            'is_render_forced' => false,
            'status_code' => 200,
        ]);

        $this->assertInstanceOf(AmazonProductResultContent::class, $result->content);
        $this->assertSame('B0846G5N74', $result->content->asin);
    }

    public function test_walmart_content_without_parse_status_code_hydrates(): void
    {
        $content = WalmartProductResultContent::from([]);

        $this->assertInstanceOf(WalmartProductResultContent::class, $content);
        $this->assertNull($content->parse_status_code);
        $this->assertFalse($content->hasParseStatus());
        $this->assertSame(ParseStatus::NOT_REPORTED, $content->getParseStatusCode());
        $this->assertFalse($content->success());
    }

    public function test_google_shopping_product_content_without_parse_status_code_hydrates(): void
    {
        $content = GoogleShoppingProductResultContent::from([]);

        $this->assertInstanceOf(GoogleShoppingProductResultContent::class, $content);
        $this->assertNull($content->parse_status_code);
        $this->assertSame(ParseStatus::NOT_REPORTED, $content->getParseStatusCode());
        $this->assertFalse($content->success());
    }

    public function test_google_shopping_pricing_content_without_parse_status_code_hydrates(): void
    {
        $content = GoogleShoppingPricingResultContent::from([]);

        $this->assertInstanceOf(GoogleShoppingPricingResultContent::class, $content);
        $this->assertNull($content->parse_status_code);
        $this->assertSame(ParseStatus::NOT_REPORTED, $content->getParseStatusCode());
        $this->assertFalse($content->success());
    }
}
