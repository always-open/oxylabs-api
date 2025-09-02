<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Walmart;

use Spatie\LaravelData\Data;

class WalmartProductPrice extends Data
{
    public function __construct(
        public readonly ?float $price = null,
        public readonly ?string $currency = null,
    ) {}
}
