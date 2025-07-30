<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use Spatie\LaravelData\Data;

class GoogleShoppingProductReviewsByStar extends Data
{
    public function __construct(
        public readonly GoogleShoppingProductReviewByStar $_1,
        public readonly GoogleShoppingProductReviewByStar $_2,
        public readonly GoogleShoppingProductReviewByStar $_3,
        public readonly GoogleShoppingProductReviewByStar $_4,
        public readonly GoogleShoppingProductReviewByStar $_5,
    ) {}
}
