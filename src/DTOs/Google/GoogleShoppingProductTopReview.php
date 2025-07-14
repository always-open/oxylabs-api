<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use Spatie\LaravelData\Data;

class GoogleShoppingProductTopReview extends Data
{
    public function __construct(
        public readonly string $text,
        public readonly string $title,
        public readonly string $author,
        public readonly int $rating,
        public readonly string $source,
    ) {}
}