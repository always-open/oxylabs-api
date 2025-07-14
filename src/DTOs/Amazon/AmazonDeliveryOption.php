<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Data;

class AmazonDeliveryOption extends Data
{
    public function __construct(
        public readonly AmazonDeliveryOptionDate $date,
        public readonly string $type,
    ) {}
}
