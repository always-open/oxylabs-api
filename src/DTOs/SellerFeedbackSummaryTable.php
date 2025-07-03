<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use AlwaysOpen\OxylabsApi\DTOs\Casters\SellerFeedbackSummaryCaster;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class SellerFeedbackSummaryTable extends Data
{
    public function __construct(
        #[WithCast(SellerFeedbackSummaryCaster::class)]
        public readonly SellerFeedbackSummary $counts,
        #[WithCast(SellerFeedbackSummaryCaster::class)]
        public readonly SellerFeedbackSummary $neutral,
        #[WithCast(SellerFeedbackSummaryCaster::class)]
        public readonly SellerFeedbackSummary $negative,
        #[WithCast(SellerFeedbackSummaryCaster::class)]
        public readonly SellerFeedbackSummary $positive,
    ) {}
}
