<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Walmart;

use Spatie\LaravelData\Data;

class WalmartProductResultContentRating extends Data
{
    public function __construct(
        public readonly int|string $count,
        public readonly float|string $rating,
    ) {}
}
