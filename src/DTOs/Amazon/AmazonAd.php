<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Data;

class AmazonAd extends Data
{
    public function __construct(
        public readonly ?int $pos = null,
        public readonly ?string $asin = null,
        public readonly ?string $type = null,
        public readonly ?float $price = null,
        public readonly ?string $title = null,
        public readonly ?array $images = null,
        public readonly ?float $rating = null,
        public readonly ?string $location = null,
        public readonly ?float $price_upper = null,
        public readonly ?int $reviews_count = null,
        public readonly ?bool $is_prime_eligible = null,
    ) {}
}
