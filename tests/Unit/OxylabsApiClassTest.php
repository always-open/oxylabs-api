<?php

namespace AlwaysOpen\OxylabsApi\Tests\Unit;

use AlwaysOpen\OxylabsApi\OxylabsApi;
use AlwaysOpen\OxylabsApi\Tests\BaseTest;

class OxylabsApiClassTest extends BaseTest
{
    public function test_retrieve_sources_for_valid_target()
    {
        $sources = OxylabsApi::getSourcesForTarget(OxylabsApi::TARGET_AMAZON);

        $this->assertIsArray($sources);
        $this->assertNotEmpty($sources);
    }

    public function test_retrieve_sources_for_invalid_target()
    {
        $sources = OxylabsApi::getSourcesForTarget('not_real');

        $this->assertIsArray($sources);
        $this->assertEmpty($sources);
    }

    public function test_verify_valid_source_with_invalid_value()
    {
        $valid = OxylabsApi::validSource('not_real');

        $this->assertFalse($valid);
    }

    public function test_verify_valid_source_with_valid_value()
    {
        $valid = OxylabsApi::validSource(OxylabsApi::SOURCE_AMAZON_SEARCH);

        $this->assertTrue($valid);
    }
}
