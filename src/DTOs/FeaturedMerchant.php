<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class FeaturedMerchant extends Data
{
    public function __construct(
        public readonly string $link,
        public readonly string $name,
        public readonly string $seller_id,
        public readonly string $shipped_from,
        public readonly bool $is_amazon_fulfilled,
    ) {
    }
}
