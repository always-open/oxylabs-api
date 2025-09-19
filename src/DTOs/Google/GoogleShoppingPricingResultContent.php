<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use AlwaysOpen\OxylabsApi\Traits\ParseStatus;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class GoogleShoppingPricingResultContent extends Data
{
    use ParseStatus;

    public function __construct(
        public readonly int $parse_status_code,
        public readonly ?string $url = null,
        public readonly ?string $title = null,
        public readonly ?float $rating = null,
        /* @var GoogleShoppingPricingOffer[] $pricing */
        #[DataCollectionOf(GoogleShoppingPricingOffer::class)]
        public readonly ?array $pricing = null,
        public readonly ?int $review_count = null,
        /* @var GoogleShoppingPricingHiddenOffer[] $hidden_offers */
        #[DataCollectionOf(GoogleShoppingPricingHiddenOffer::class)]
        public readonly ?array $hidden_offers = null,
    ) {}

    public function success(): bool
    {
        return $this->getParseStatusCode() === \AlwaysOpen\OxylabsApi\Enums\ParseStatus::SUCCESS;
    }
}
