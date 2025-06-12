<?php

namespace AlwaysOpen\OxylabsApi\Tests\Unit\DTOs;

use AlwaysOpen\OxylabsApi\DTOs\AmazonProductRequest;
use AlwaysOpen\OxylabsApi\OxylabsApiServiceProvider;
use Orchestra\Testbench\TestCase;

class AmazonProductRequestTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [OxylabsApiServiceProvider::class];
    }

    public function test_to_array()
    {
        $request = new AmazonProductRequest(
            source: 'amazon',
            domain: 'com',
            asin: 'B0000000',
            parse: [
                'product' => [
                    'title' => true,
                    'price' => true,
                    'description' => true,
                    'images' => true,
                    'rating' => true,
                    'reviews' => true,
                    'availability' => true,
                    'seller' => true,
                    'shipping' => true,
                    'specifications' => true,
                    'variations' => true,
                    'questions' => true,
                    'answers' => true,
                    'related' => true,
                    'sponsored' => true,
                    'categories' => true,
                    'breadcrumbs' => true,
                    'metadata' => true,
                ],
            ],
            context: [
                [
                    'key' => 'headers',
                    'value' => [
                        'Accept-Language' => 'en-US',
                        'Content-Type' => 'application/octet-stream',
                        'Custom-Header-Name' => 'custom header content',
                    ],
                ],
                [
                    'key' => 'cookies',
                    'value' => [
                        [
                            'key' => 'NID',
                            'value' => '1234567890',
                        ],
                        [
                            'key' => '1P JAR',
                            'value' => '0987654321',
                        ],
                    ],
                ],
                [
                    'key' => 'follow_redirects',
                    'value' => true,
                ],
                [
                    'key' => 'http_method',
                    'value' => 'get',
                ],
                [
                    'key' => 'content',
                    'value' => 'YmFzZTY0RW5jb2RlZFBPU1RCb2R5',
                ],
                [
                    'key' => 'successful_status_codes',
                    'value' => [808, 909],
                ],
            ]
        );

        $this->assertEquals([
            'source' => 'amazon',
            'domain' => 'com',
            'asin' => 'B0000000',
            'parse' => [
                'product' => [
                    'title' => true,
                    'price' => true,
                    'description' => true,
                    'images' => true,
                    'rating' => true,
                    'reviews' => true,
                    'availability' => true,
                    'seller' => true,
                    'shipping' => true,
                    'specifications' => true,
                    'variations' => true,
                    'questions' => true,
                    'answers' => true,
                    'related' => true,
                    'sponsored' => true,
                    'categories' => true,
                    'breadcrumbs' => true,
                    'metadata' => true,
                ],
            ],
            'context' => [
                [
                    'key' => 'headers',
                    'value' => [
                        'Accept-Language' => 'en-US',
                        'Content-Type' => 'application/octet-stream',
                        'Custom-Header-Name' => 'custom header content',
                    ],
                ],
                [
                    'key' => 'cookies',
                    'value' => [
                        [
                            'key' => 'NID',
                            'value' => '1234567890',
                        ],
                        [
                            'key' => '1P JAR',
                            'value' => '0987654321',
                        ],
                    ],
                ],
                [
                    'key' => 'follow_redirects',
                    'value' => true,
                ],
                [
                    'key' => 'http_method',
                    'value' => 'get',
                ],
                [
                    'key' => 'content',
                    'value' => 'YmFzZTY0RW5jb2RlZFBPU1RCb2R5',
                ],
                [
                    'key' => 'successful_status_codes',
                    'value' => [808, 909],
                ],
            ],
        ], $request->toArray());
    }
}
