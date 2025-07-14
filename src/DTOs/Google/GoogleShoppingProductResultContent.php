<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use AlwaysOpen\OxylabsApi\Traits\ParseStatus;
use Spatie\LaravelData\Data;

class GoogleShoppingProductResultContent extends Data
{
    use ParseStatus;

    public function __construct(
        public readonly string $url,
        public readonly string $title,
        public readonly GoogleShoppingProductImages $images,
        public readonly GoogleShoppingProductPricing $pricing,
        public readonly GoogleShoppingProductReviews $reviews,
        public readonly array $variants,
        public readonly array $highlights,
        public readonly string $description,
        public readonly array $related_items,
        public readonly array $specifications,
        public readonly int $parse_status_code,
        public readonly ?array $product_details_keywords = null,
    ) {}
}