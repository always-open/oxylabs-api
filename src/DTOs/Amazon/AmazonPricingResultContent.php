<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class AmazonPricingResultContent extends Data
{
    public const int MAX_PRICES_PER_PAGE = 10;

    public function __construct(
        public readonly string $url,
        public readonly string $asin,
        public readonly int $page,
        public readonly string $title,
        /* @var AmazonPricingResultContentPricing[] $pricing */
        #[DataCollectionOf(AmazonPricingResultContentPricing::class)]
        public readonly array $pricing,
        public readonly string $asin_in_url,
        public readonly int $review_count,
        public readonly int $parse_status_code,
        public readonly ?array $_warnings = null,
    ) {}

    public function hasMaxResults(): bool
    {
        return count($this->pricing) >= self::MAX_PRICES_PER_PAGE;
    }

    public function nextPage(): int
    {
        return $this->page + 1;
    }
}
