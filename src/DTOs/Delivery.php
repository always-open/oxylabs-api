<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class Delivery extends Data
{
    public function __construct(
        public readonly string $type,
        public readonly DeliveryDate $date,
    ) {
    }
}
