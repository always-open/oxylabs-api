<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class ProductDetails extends Data
{
    public function __construct(
        public readonly string $asin,
        public readonly string $manufacturer,
        public readonly string $country_of_origin,
        public readonly string $item_model_number,
        public readonly string $product_dimensions,
        public readonly string $date_first_available,
        public readonly string $is_discontinued_by_manufacturer,
    ) {
    }
}
