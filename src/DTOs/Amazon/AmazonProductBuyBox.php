<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class AmazonProductBuyBox extends Data
{
    public function __construct(
        public readonly float $price,
        public readonly ?string $stock = null,
        public readonly ?string $condition = null,
        /* @var AmazonDeliveryDetail[] $delivery_details */
        #[DataCollectionOf(AmazonDeliveryDetail::class)]
        public readonly array $delivery_details = [],
    ) {}
}
