<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use AlwaysOpen\OxylabsApi\Traits\ParseStatus;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\DataCollectionOf;

class GoogleShoppingPricingResultContent extends Data
{
    use ParseStatus;

    public function __construct(
        public readonly string $url,
        public readonly string $title,
        #[DataCollectionOf(GoogleShoppingPricingOffer::class)]
        public readonly DataCollection $pricing,
        public readonly int $review_count,
        #[DataCollectionOf(GoogleShoppingPricingHiddenOffer::class)]
        public readonly DataCollection $hidden_offers,
        public readonly int $parse_status_code,
    ) {}
}