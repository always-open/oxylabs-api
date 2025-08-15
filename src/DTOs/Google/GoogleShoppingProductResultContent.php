<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use AlwaysOpen\OxylabsApi\Traits\ParseStatus;
use Spatie\LaravelData\Data;

class GoogleShoppingProductResultContent extends Data
{
    use ParseStatus;

    public function __construct(
        public readonly int $parse_status_code,
        public readonly ?string $url = null,
        public readonly ?string $title = null,
        public readonly ?GoogleShoppingProductPricing $pricing = null,
        public readonly ?GoogleShoppingProductReviews $reviews = null,
        public readonly ?array $variants = null,
        public readonly ?array $highlights = null,
        public readonly ?string $description = null,
        public readonly ?array $related_items = null,
        public readonly ?array $specifications = null,
        public readonly ?GoogleShoppingProductImages $images = null,
        public readonly ?array $product_details_keywords = null,
    ) {}

    public function success() : bool
    {
        return $this->getParseStatusCode() === \AlwaysOpen\OxylabsApi\Enums\ParseStatus::SUCCESS;
    }
}
