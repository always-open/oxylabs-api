<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
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
        #[DataCollectionOf(AmazonDeliveryOption::class)]
        public readonly array $delivery_options,
    ) {}
}
