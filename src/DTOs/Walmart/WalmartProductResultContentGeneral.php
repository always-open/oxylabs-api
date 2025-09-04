<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Walmart;

use Spatie\LaravelData\Data;

class WalmartProductResultContentGeneral extends Data
{
    public function __construct(
        public readonly ?string $url = null,
        public readonly ?array $meta = null,
        public readonly ?string $brand = null,
        public readonly ?string $title = null,
        public readonly ?string $description = null,
        public readonly ?array $images = null,
        public readonly ?string $main_image = null,
        public readonly ?array $badge = null,
    ) {}
}
