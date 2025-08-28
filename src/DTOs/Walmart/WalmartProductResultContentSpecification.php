<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Walmart;

use Spatie\LaravelData\Data;

class WalmartProductResultContentSpecification extends Data
{
    public function __construct(
        public readonly string $key,
        public readonly string $value,
    ) {}
}
