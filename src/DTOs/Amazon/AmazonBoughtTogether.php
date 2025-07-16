<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Data;

class AmazonBoughtTogether extends Data
{
    public function __construct(
        public readonly string $asin,
    ) {}
}
