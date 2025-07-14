<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use Spatie\LaravelData\Data;

class GoogleShoppingPricingHiddenOffer extends Data
{
    public function __construct(
        public readonly string $url,
        public readonly float $price,
        public readonly string $currency,
        public readonly float $total_price,
        public readonly string $sellers_name,
        public readonly float $shipping_price,
    ) {}
}