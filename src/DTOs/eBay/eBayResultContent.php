<?php

namespace AlwaysOpen\OxylabsApi\DTOs\eBay;

use AlwaysOpen\OxylabsApi\Traits\Renderable;
use Spatie\LaravelData\Data;

class eBayResultContent extends Data
{
    use Renderable;

    public function __construct(
        public readonly array $ids,
        public readonly string $url,
        public readonly string $brand,
        public readonly string $image,
        public readonly float $price,
        public readonly string $title,
        public readonly string $currency,
        public readonly ?float $old_price,
        public readonly string $description,
        public readonly bool $availability,
        public readonly int $parse_status_code,
        public readonly array $additional_properties,
    ) {}
}
