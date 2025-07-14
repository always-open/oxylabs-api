<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\DataCollectionOf;

class GoogleShoppingProductPricing extends Data
{
    public function __construct(
        #[DataCollectionOf(GoogleShoppingProductPricingOnline::class)]
        public readonly DataCollection $online,
    ) {}
}