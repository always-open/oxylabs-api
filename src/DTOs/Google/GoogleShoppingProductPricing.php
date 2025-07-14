<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class GoogleShoppingProductPricing extends Data
{
    public function __construct(
        #[DataCollectionOf(GoogleShoppingProductPricingOnline::class)]
        public readonly DataCollection $online,
    ) {}
}
