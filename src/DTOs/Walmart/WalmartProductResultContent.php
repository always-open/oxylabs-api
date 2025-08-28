<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Walmart;

use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonAd;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonBoughtTogether;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonBuyItWith;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonProductBuyBox;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonRatingStarDistribution;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonReview;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonSalesRank;
use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonVariation;
use AlwaysOpen\OxylabsApi\DTOs\Delivery;
use AlwaysOpen\OxylabsApi\DTOs\FeaturedMerchant;
use AlwaysOpen\OxylabsApi\DTOs\LightningDeal;
use AlwaysOpen\OxylabsApi\DTOs\ProductDetails;
use AlwaysOpen\OxylabsApi\DTOs\WarrantyAndSupport;
use AlwaysOpen\OxylabsApi\Traits\ParseStatus;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class WalmartProductResultContent extends Data
{
    use ParseStatus;

    public function __construct(
        public readonly int $parse_status_code,
        public readonly WalmartProductResultContentPrice|null $price = null,
        public readonly WalmartProductResultContentRating|null $rating = null,
        public readonly WalmartProductResultContentSeller|null $seller = null,
        public readonly WalmartProductResultContentGeneral|null $general = null,
        public readonly WalmartProductResultContentLocation|null $location = null,
        /* @var WalmartProductResultContentVariation[] $variations */
        #[DataCollectionOf(WalmartProductResultContentVariation::class)]
        public readonly array|null $variations = null,
        /* @var WalmartProductResultContentBreadcrumb[] $breadcrumbs */
        #[DataCollectionOf(WalmartProductResultContentBreadcrumb::class)]
        public readonly array|null $breadcrumbs = null,
        /* @var WalmartProductResultContentSpecification[] $specifications */
        #[DataCollectionOf(WalmartProductResultContentSpecification::class)]
        public readonly array|null $specifications = null,
        public readonly string|null $cheapest_seller_name = null,
        public readonly string|float|null $sold_by_walmart_price = null,
    ) {}

    public function success(): bool
    {
        return $this->getParseStatusCode() === \AlwaysOpen\OxylabsApi\Enums\ParseStatus::SUCCESS;
    }
}
