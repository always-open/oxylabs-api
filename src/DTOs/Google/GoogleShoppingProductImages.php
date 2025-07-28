<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use Spatie\LaravelData\Data;

class GoogleShoppingProductImages extends Data
{
    public function __construct(
        /* @var string[] $full_size */
        public readonly array $full_size,
        /* @var string[] $thumbnails */
        public readonly array $thumbnails,
    ) {}
}
