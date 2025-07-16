<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Data;

class AmazonReview extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly string $author,
        public readonly float $rating,
        public readonly string $content,
        public readonly string $timestamp,
        public readonly bool $is_verified,
        public readonly string $review_from,
        public readonly ?string $profile_id = null,
        public readonly ?string $product_attributes = null,
    ) {}
}
