<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Walmart;

use Spatie\LaravelData\Data;

class WalmartProductResultContentBreadcrumb extends Data
{
    public function __construct(
        public readonly string $url,
        public readonly string $category_name,
    ) {}
}
