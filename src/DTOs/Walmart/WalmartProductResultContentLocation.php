<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Walmart;

use Spatie\LaravelData\Data;

class WalmartProductResultContentLocation extends Data
{
    public function __construct(
        public readonly ?string $city = null,
        public readonly ?string $state = null,
        public readonly ?string $store_id = null,
        public readonly ?string $zip_code = null,
    ) {}
}
