<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Data;

class AmazonBuyItWith extends Data
{
    public function __construct(
        public readonly ?string $asin = null,
        public readonly ?float $price = null,
        public readonly ?string $title = null,
    ) {}
}
