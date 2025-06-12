<?php

namespace AlwaysOpen\OxylabsApi\Tests\Unit\DTOs;

use AlwaysOpen\OxylabsApi\DTOs\AmazonSellersRequest;
use AlwaysOpen\OxylabsApi\OxylabsApiServiceProvider;
use Orchestra\Testbench\TestCase;

class AmazonSellersRequestTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [OxylabsApiServiceProvider::class];
    }

    public function test_to_array()
    {
        $request = new AmazonSellersRequest(
            source: 'amazon',
            domain: 'com',
            query: 'test',
            parse: [
                'sellers' => [
                    'name' => true,
                    'rating' => true,
                    'reviews' => true,
                    'feedback' => true,
                    'location' => true,
                    'shipping' => true,
                    'returns' => true,
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
            'query' => 'test',
            'parse' => [
                'sellers' => [
                    'name' => true,
                    'rating' => true,
                    'reviews' => true,
                    'feedback' => true,
                    'location' => true,
                    'shipping' => true,
                    'returns' => true,
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
