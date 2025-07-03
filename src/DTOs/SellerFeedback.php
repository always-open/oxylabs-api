<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class SellerFeedback extends Data
{
    public function __construct(
        public readonly string $feedback,
        public readonly string $rated_by,
        public readonly int $rating_stars,
    ) {}
}
