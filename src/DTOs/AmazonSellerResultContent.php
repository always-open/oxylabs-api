<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use AlwaysOpen\OxylabsApi\Traits\ParseStatus;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class AmazonSellerResultContent extends Data
{
    use ParseStatus;

    public function __construct(
        public readonly string $url,
        public readonly string $query,
        public readonly float $rating,
        public readonly string $page_type,
        public readonly string $description,
        public readonly string $business_name,
        /* @var SellerFeedback[] $recent_feedback */
        #[DataCollectionOf(SellerFeedback::class)]
        public readonly array $recent_feedback,
        public readonly string $business_address,
        public readonly int $parse_status_code,
        public readonly SellerFeedbackSummaryTable $feedback_summary_table,
    ) {}
}
