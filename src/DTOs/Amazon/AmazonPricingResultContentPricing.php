<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class AmazonPricingResultContentPricing extends Data
{
    public function __construct(
        public readonly float $price,
        public readonly string $seller,
        public readonly string $currency,
        public readonly string $delivery,
        public readonly string $condition,
        public readonly string $seller_id,
        public readonly string $seller_link,
        public readonly int $rating_count,
        public readonly float $price_shipping,
        /* @var AmazonDeliveryOption[] $delivery_options */
        #[DataCollectionOf(AmazonDeliveryOption::class)]
        public readonly array $delivery_options,
    ) {}
}
