<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Walmart;

use Spatie\LaravelData\Data;

class WalmartProductResultContentVariation extends Data
{
    public function __construct(
        public readonly string $state,
        public readonly string $product_id,
        public readonly ?WalmartProductResultContentPrice $price = null,
        public readonly ?array $selected_options = null,
    ) {}
}
