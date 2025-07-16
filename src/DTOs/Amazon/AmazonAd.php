<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Data;

class AmazonAd extends Data
{
    public function __construct(
        public readonly int $pos,
        public readonly string $asin,
        public readonly string $type,
        public readonly float $price,
        public readonly string $title,
        public readonly array $images,
        public readonly float $rating,
        public readonly string $location,
        public readonly float $price_upper,
        public readonly int $reviews_count,
        public readonly bool $is_prime_eligible,
    ) {}
}
