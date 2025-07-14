<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use Spatie\LaravelData\Data;

class GoogleShoppingProductReviews extends Data
{
    public function __construct(
        public readonly float $rating,
        public readonly GoogleShoppingProductTopReview $top_review,
        public readonly int $rating_stars,
        public readonly int $reviews_count,
        public readonly array $reviews_by_stars,
        public readonly array $search_suggestions,
    ) {}
}
