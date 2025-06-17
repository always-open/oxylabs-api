<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class DeliveryDate extends Data
{
    public function __construct(
        public readonly ?string $from = null,
        public readonly ?string $by = null,
    ) {
    }
}
