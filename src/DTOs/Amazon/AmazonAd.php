<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Data;

class AmazonAd extends Data
{
    public function __construct(
        public readonly int|null $pos = null,
        public readonly string|null $asin = null,
        public readonly string|null $type = null,
        public readonly float|null $price = null,
        public readonly string|null $title = null,
        public readonly array|null $images = null,
        public readonly float|null $rating = null,
        public readonly string|null $location = null,
        public readonly float|null $price_upper = null,
        public readonly int|null $reviews_count = null,
        public readonly bool|null $is_prime_eligible = null,
    ) {}
}
