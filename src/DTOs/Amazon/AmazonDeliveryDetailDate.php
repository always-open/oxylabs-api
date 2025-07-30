<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Data;

class AmazonDeliveryDetailDate extends Data
{
    public function __construct(
        public readonly string $by,
    ) {}
}
