<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;

class AmazonProductBuyBox extends Data
{
    public function __construct(
        public readonly float  $price,
        public readonly string|null $stock = null,
        public readonly string|null $condition = null,
        /* @var AmazonDeliveryDetail[] $delivery_details */
        #[DataCollectionOf(AmazonDeliveryDetail::class)]
        public readonly array $delivery_details = [],
    ) {}
}
