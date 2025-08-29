<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Walmart;

use Spatie\LaravelData\Data;

class WalmartProductResultContentFulfillment extends Data
{
    public function __construct(
        public readonly bool|null $pickup = null,
        public readonly bool|null $delivery = null,
        public readonly bool|null $shipping = null,
        public readonly bool|null $out_of_stock = null,
        public readonly bool|null $free_shipping = null,
        public readonly string|null $pickup_information = null,
        public readonly string|null $delivery_information = null,
        public readonly string|null $shipping_information = null,
    ) {}
}
