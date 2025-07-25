<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use AlwaysOpen\OxylabsApi\DTOs\Casters\SellerFeedbackSummaryDataCaster;
use AlwaysOpen\OxylabsApi\DTOs\SellerFeedback;
use AlwaysOpen\OxylabsApi\DTOs\SellerFeedbackSummaryData;
use AlwaysOpen\OxylabsApi\DTOs\SellerFeedbackSummaryTable;
use AlwaysOpen\OxylabsApi\Traits\ParseStatus;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class AmazonSellerResultContent extends Data
{
    use ParseStatus;

    public function __construct(
        public readonly string $url,
        public readonly string $query,
        public readonly string $seller_name,
        public readonly float $rating,
        public readonly string $page_type,
        public readonly string $description,
        public readonly string $business_name,
        /* @var SellerFeedback[] $recent_feedback */
        #[DataCollectionOf(SellerFeedback::class)]
        public readonly array $recent_feedback,
        public readonly string $business_address,
        public readonly int $parse_status_code,
        public readonly ?SellerFeedbackSummaryTable $feedback_summary_table = null,
        #[WithCast(SellerFeedbackSummaryDataCaster::class)]
        public readonly ?SellerFeedbackSummaryData $feedback_summary_data = null,
    ) {}
}
