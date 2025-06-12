<?php

namespace AlwaysOpen\OxylabsApi\Tests\Unit\DTOs;

use AlwaysOpen\OxylabsApi\DTOs\AmazonProductResponse;
use AlwaysOpen\OxylabsApi\OxylabsApiServiceProvider;
use Orchestra\Testbench\TestCase;

class AmazonProductResponseTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [OxylabsApiServiceProvider::class];
    }

    public function test_from_array()
    {
        $data = ['test' => 'data'];

        $response = AmazonProductResponse::fromArray($data);

        $this->assertEquals($data, $response->data);
    }
} 