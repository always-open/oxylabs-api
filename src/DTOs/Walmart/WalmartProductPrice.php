<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Walmart;

use Spatie\LaravelData\Data;

class WalmartProductPrice extends Data
{
    public function __construct(
        public readonly float $price,
        public readonly string|null $currency = null,
    ) {}
}
