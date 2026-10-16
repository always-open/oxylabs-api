<?php

namespace AlwaysOpen\OxylabsApi\Tests\Unit\DTOs;

use AlwaysOpen\OxylabsApi\DTOs\Walmart\WalmartProductResponse;
use AlwaysOpen\OxylabsApi\DTOs\Walmart\WalmartProductResultContent;
use AlwaysOpen\OxylabsApi\DTOs\Walmart\WalmartProductResultContentSeller;
use AlwaysOpen\OxylabsApi\Tests\BaseTest;

class WalmartProductResultContentSellerTest extends BaseTest
{
    public function test_seller_without_official_name_hydrates_with_null()
    {
        $seller = WalmartProductResultContentSeller::from([
            'id' => 'F7FC8FD8BA3D4C6998D2C4AFFD3B9970',
            'url' => 'https://www.walmart.com/global/seller/5442',
            'name' => 'Pattern',
            'catalog_id' => '5442',
        ]);

        $this->assertSame('Pattern', $seller->name);
        $this->assertSame('5442', $seller->catalog_id);
        $this->assertNull($seller->official_name);
    }

    public function test_seller_official_name_is_kept_when_present()
    {
        $seller = WalmartProductResultContentSeller::from([
            'id' => 'F7FC8FD8BA3D4C6998D2C4AFFD3B9970',
            'url' => 'https://www.walmart.com/global/seller/5442',
            'name' => 'Pattern',
            'catalog_id' => '5442',
            'official_name' => 'Pattern Inc.',
        ]);

        $this->assertSame('Pattern Inc.', $seller->official_name);
    }

    public function test_product_response_whose_seller_has_no_official_name_hydrates_content()
    {
        $response = WalmartProductResponse::from([
            'results' => [[
                'content' => [
                    'parse_status_code' => 12000,
                    'price' => ['price' => 24.99, 'currency' => 'USD'],
                    'rating' => ['count' => 12, 'rating' => 4.4],
                    'seller' => [
                        'id' => 'F7FC8FD8BA3D4C6998D2C4AFFD3B9970',
                        'url' => 'https://www.walmart.com/global/seller/5442',
                        'name' => 'Pattern',
                        'catalog_id' => '5442',
                    ],
                    'general' => [
                        'url' => 'https://www.walmart.com/ip/12345678',
                        'meta' => [],
                        'brand' => null,
                        'title' => 'Test Product',
                    ],
                    'fulfillment' => ['out_of_stock' => false, 'shipping_information' => 'Free'],
                ],
                'page' => 1,
                'url' => 'https://www.walmart.com/ip/12345678',
                'job_id' => '7516785895786203137',
                'is_render_forced' => false,
                'status_code' => 200,
            ]],
        ]);

        $content = $response->results[0]->content;

        $this->assertInstanceOf(WalmartProductResultContent::class, $content);
        $this->assertSame('5442', $content->seller->catalog_id);
        $this->assertNull($content->seller->official_name);
    }
}
