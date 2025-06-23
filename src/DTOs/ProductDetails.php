<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class ProductDetails extends Data
{
    public function __construct(
        public readonly string $asin,
        public readonly string $manufacturer,
        public readonly string $date_first_available,
        public readonly string $brand,
        public readonly string $customer_reviews,
        public readonly string $best_sellers_rank,
        public readonly ?string $is_discontinued_by_manufacturer = null,
        public readonly ?string $item_model_number = null,
        public readonly ?string $country_of_origin = null,
        public readonly ?string $product_dimensions = null,
    ) {}
}
