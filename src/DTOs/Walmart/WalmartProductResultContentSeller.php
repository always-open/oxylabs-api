<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Walmart;

use Spatie\LaravelData\Data;

class WalmartProductResultContentSeller extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly string|null $url,
        public readonly string $name,
        public readonly string|null $catalog_id,
        public readonly string $official_name,
    ) {}
}
