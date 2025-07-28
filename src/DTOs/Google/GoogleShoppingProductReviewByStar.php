<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use Spatie\LaravelData\Data;

class GoogleShoppingProductReviewByStar extends Data
{
    public function __construct(
        public readonly string $url,
        public readonly int $reviews_count,
    ) {}
}
