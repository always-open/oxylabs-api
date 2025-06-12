<?php

namespace AlwaysOpen\OxylabsApi\Tests\Unit\DTOs;

use AlwaysOpen\OxylabsApi\DTOs\AmazonSellersResponse;
use AlwaysOpen\OxylabsApi\OxylabsApiServiceProvider;
use Orchestra\Testbench\TestCase;

class AmazonSellersResponseTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [OxylabsApiServiceProvider::class];
    }

    public function test_from_array()
    {
        $data = ['test' => 'data'];

        $response = AmazonSellersResponse::fromArray($data);

        $this->assertEquals($data, $response->data);
    }
} 