<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use AlwaysOpen\OxylabsApi\Traits\ParseStatus;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class GoogleShoppingPricingResultContent extends Data
{
    use ParseStatus;

    public function __construct(
        public readonly string $url,
        public readonly string $title,
        public readonly int $rating,
        /* @var GoogleShoppingPricingOffer[] $pricing */
        #[DataCollectionOf(GoogleShoppingPricingOffer::class)]
        public readonly array $pricing,
        public readonly int $review_count,
        public readonly int $parse_status_code,
        /* @var GoogleShoppingPricingHiddenOffer[] $hidden_offers */
        #[DataCollectionOf(GoogleShoppingPricingHiddenOffer::class)]
        public readonly ?array $hidden_offers = null,
    ) {}
}
