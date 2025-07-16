<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Data;

class AmazonBuyItWith extends Data
{
    public function __construct(
        public readonly string $asin,
        public readonly float $price,
        public readonly string $title,
    ) {}
}
