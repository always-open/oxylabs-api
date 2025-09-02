<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Walmart;

use Spatie\LaravelData\Data;

class WalmartProductResultContentPrice extends Data
{
    public function __construct(
        public readonly ?float $price = null,
        public readonly ?string $currency = null,
        public readonly null|string|float $price_strikethrough = null,
    ) {}
}
