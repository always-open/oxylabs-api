<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class FeaturedMerchant extends Data
{
    public function __construct(
        public readonly ?string $link = null,
        public readonly ?string $name = null,
        public readonly ?string $seller_id = null,
        public readonly ?string $shipped_from = null,
        public readonly ?bool $is_amazon_fulfilled = null,
    ) {}
}
