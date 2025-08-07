<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class ProductDetails extends Data
{
    public function __construct(
        public readonly string $asin,
        public readonly ?string $manufacturer = null,
        public readonly ?string $brand = null,
        public readonly ?string $customer_reviews = null,
        public readonly ?string $best_sellers_rank = null,
        public readonly ?string $date_first_available = null,
        public readonly ?string $is_discontinued_by_manufacturer = null,
        public readonly ?string $item_model_number = null,
        public readonly ?string $country_of_origin = null,
        public readonly ?string $product_dimensions = null,
    ) {}
}
