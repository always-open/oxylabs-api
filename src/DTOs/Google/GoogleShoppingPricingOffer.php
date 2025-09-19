<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use Spatie\LaravelData\Data;

class GoogleShoppingPricingOffer extends Data
{
    public function __construct(
        public readonly float $price,
        public readonly string $details,
        public readonly string $condition,
        public readonly string $seller_link,
        public readonly float|string $price_shipping,
        public readonly ?string $currency = null,
        public readonly ?string $seller = null,
        public readonly ?float $price_tax = null,
        public readonly ?float $price_total = null,
    ) {}
}
