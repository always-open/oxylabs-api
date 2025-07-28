<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class GoogleShoppingProductPricing extends Data
{
    public function __construct(
        /* @var GoogleShoppingProductPricingOnline[] $online */
        #[DataCollectionOf(GoogleShoppingProductPricingOnline::class)]
        public readonly array $online,
    ) {}
}
