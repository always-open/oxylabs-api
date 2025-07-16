<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Data;

class AmazonRatingStarDistribution extends Data
{
    public function __construct(
        public readonly int $rating,
        public readonly float $percentage,
    ) {}
}
