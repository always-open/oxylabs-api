<?php

namespace AlwaysOpen\OxylabsApi\Tests\Unit\DTOs;

use AlwaysOpen\OxylabsApi\DTOs\AmazonPricingResponse;
use AlwaysOpen\OxylabsApi\Tests\BaseTest;

class AmazonPricingResponseTest extends BaseTest
{
    public function test_from_array()
    {
        $data = $this->getFixtureJsonContent('amazon_pricing_results.json');

        $response = AmazonPricingResponse::from($data);

        $this->assertEquals($data['results'][0]['url'], $response->results[0]->url);
    }
}
