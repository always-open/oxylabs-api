<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Data;

class AmazonDeliveryOptionDate extends Data
{
    public function __construct(
        public readonly string $by,
    ) {}
}
