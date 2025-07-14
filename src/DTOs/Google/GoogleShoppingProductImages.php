<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use Spatie\LaravelData\Data;

class GoogleShoppingProductImages extends Data
{
    public function __construct(
        public readonly array $full_size,
        public readonly array $thumbnails,
    ) {}
}