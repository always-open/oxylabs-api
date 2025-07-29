<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Data;

class AmazonDeliveryDetail extends Data
{
    public function __construct(
        public readonly AmazonDeliveryDetailDate $date,
        public readonly string $type,
    ) {}
}
