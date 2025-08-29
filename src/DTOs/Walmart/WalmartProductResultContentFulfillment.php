<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Walmart;

use Spatie\LaravelData\Data;

class WalmartProductResultContentFulfillment extends Data
{
    public function __construct(
        public readonly ?bool $pickup = null,
        public readonly ?bool $delivery = null,
        public readonly ?bool $shipping = null,
        public readonly ?bool $out_of_stock = null,
        public readonly ?bool $free_shipping = null,
        public readonly ?string $pickup_information = null,
        public readonly ?string $delivery_information = null,
        public readonly ?string $shipping_information = null,
    ) {}
}
