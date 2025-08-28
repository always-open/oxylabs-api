<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Walmart;

use Spatie\LaravelData\Data;

class WalmartProductResultContentGeneral extends Data
{
    public function __construct(
        public readonly string $url,
        public readonly array $meta,
        public readonly string $brand,
        public readonly string $title,
        public readonly string $description,
        public readonly array|null $images = null,
        public readonly string|null $main_image = null,
        public readonly array|null $badge = null,
    ) {}
}
