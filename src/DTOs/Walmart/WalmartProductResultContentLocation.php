<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Walmart;

use Spatie\LaravelData\Data;

class WalmartProductResultContentLocation extends Data
{
    public function __construct(
        public readonly string|null $city = null,
        public readonly string|null $state = null,
        public readonly string|null $store_id = null,
        public readonly string|null $zip_code = null,
    ) {}
}
