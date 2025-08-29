<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Walmart;

use AlwaysOpen\OxylabsApi\Traits\ParseStatus;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class WalmartProductResultContent extends Data
{
    use ParseStatus;

    public function __construct(
        public readonly int $parse_status_code,
        public readonly ?WalmartProductResultContentPrice $price = null,
        public readonly ?WalmartProductResultContentRating $rating = null,
        public readonly ?WalmartProductResultContentSeller $seller = null,
        public readonly ?WalmartProductResultContentGeneral $general = null,
        public readonly ?WalmartProductResultContentLocation $location = null,
        /* @var WalmartProductResultContentVariation[] $variations */
        #[DataCollectionOf(WalmartProductResultContentVariation::class)]
        public readonly ?array $variations = null,
        /* @var WalmartProductResultContentBreadcrumb[] $breadcrumbs */
        #[DataCollectionOf(WalmartProductResultContentBreadcrumb::class)]
        public readonly ?array $breadcrumbs = null,
        /* @var WalmartProductResultContentSpecification[] $specifications */
        #[DataCollectionOf(WalmartProductResultContentSpecification::class)]
        public readonly ?array $specifications = null,
        public readonly ?string $cheapest_seller_name = null,
        public readonly ?WalmartProductResultContentFulfillment $fulfillment = null,
        public readonly string|float|null $sold_by_walmart_price = null,
    ) {}

    public function success(): bool
    {
        return $this->getParseStatusCode() === \AlwaysOpen\OxylabsApi\Enums\ParseStatus::SUCCESS;
    }
}
