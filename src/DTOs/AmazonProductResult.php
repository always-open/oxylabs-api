<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class AmazonProductResult extends Data
{
    public function __construct(
        public readonly string $url,
        public readonly int $page,
        public readonly string $page_type,
        public readonly string $asin,
        public readonly string $asin_in_url,
        public readonly string $title,
        public readonly string $manufacturer,
        public readonly string $product_name,
        public readonly string $description,
        public readonly int $rating,
        public readonly float $price,
        public readonly float $price_sns,
        public readonly float $price_initial,
        public readonly float $price_buybox,
        public readonly bool $is_prime_eligible,
        public readonly string $currency,
        public readonly string $stock,
        public readonly int $reviews_count,
        public readonly array $images,
        public readonly bool $has_videos,
        public readonly string $job_id,
        public readonly int $status_code,
        public readonly int $parse_status_code,
        public readonly ?string $bullet_points = null,
        public readonly ?array $category = null,
        public readonly ?array $variation = null,
        public readonly ?float $price_upper = null,
        public readonly ?float $price_shipping = null,
        public readonly ?string $deal_type = null,
        public readonly ?string $coupon = null,
        public readonly ?bool $is_addon_item = null,
        public readonly ?string $discount_end = null,
        public readonly ?array $reviews = null,
        public readonly ?int $answered_questions_count = null,
        public readonly ?int $pricing_count = null,
        public readonly ?string $pricing_url = null,
        public readonly ?string $pricing_str = null,
        public readonly ?FeaturedMerchant $featured_merchant = null,
        public readonly ?array $sales_rank = null,
        public readonly ?array $sns_discounts = null,
        public readonly ?array $developer_info = null,
        public readonly ?array $product_overview = null,
        public readonly ?string $store_url = null,
        public readonly Delivery|array|null $delivery = null,
        public readonly ?string $brand = null,
        public readonly ?string $item_form = null,
        public readonly ?string $sales_volume = null,
        public readonly ?string $other_sellers = null,
        public readonly ?array $rating_stars_distribution = null,
        public readonly ?array $buybox = null,
        public readonly ?LightningDeal $lightning_deal = null,
        public readonly ?ProductDetails $product_details = null,
        public readonly ?string $product_dimensions = null,
        public readonly ?int $max_quantity = null,
        public readonly ?array $ads = null,
        public readonly ?WarrantyAndSupport $warranty_and_support = null,
        public readonly ?float $discount_percentage = null,
        public readonly ?bool $amazon_choice = null,
        public readonly ?float $coupon_discount_percentage = null,
        public readonly ?string $parent_asin = null,
        #[WithCast(DateTimeInterfaceCast::class, format: "Y-m-d H:i:s")]
        public readonly ?Carbon $created_at = null,
        #[WithCast(DateTimeInterfaceCast::class, format: "Y-m-d H:i:s")]
        public readonly ?Carbon $updated_at = null,
        public readonly ?bool $is_prime_pantry = null,
    ) {
    }
}
