<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class LightningDeal extends Data
{
    public function __construct(
        public readonly string $percent_claimed,
        public readonly string $price_text,
        public readonly string $expires,
    ) {}
}
