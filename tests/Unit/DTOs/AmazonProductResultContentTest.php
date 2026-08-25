<?php

namespace AlwaysOpen\OxylabsApi\Tests\Unit\DTOs;

use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonProductResultContent;
use AlwaysOpen\OxylabsApi\Tests\BaseTest;

class AmazonProductResultContentTest extends BaseTest
{
    public function test_fractional_rating_is_preserved_as_float()
    {
        $content = AmazonProductResultContent::from([
            'parse_status_code' => 12000,
            'rating' => 4.9,
            'reviews_count' => 138,
        ]);

        $this->assertSame(4.9, $content->rating);
    }

    public function test_whole_number_rating_is_a_float()
    {
        $content = AmazonProductResultContent::from([
            'parse_status_code' => 12000,
            'rating' => 5,
        ]);

        $this->assertSame(5.0, $content->rating);
    }
}
