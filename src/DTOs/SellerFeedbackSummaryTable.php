<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use AlwaysOpen\OxylabsApi\DTOs\Casters\SellerFeedbackSummaryTableEntryCaster;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class SellerFeedbackSummaryTable extends Data
{
    public function __construct(
        #[WithCast(SellerFeedbackSummaryTableEntryCaster::class)]
        public readonly SellerFeedbackSummaryTableEntry $counts,
        #[WithCast(SellerFeedbackSummaryTableEntryCaster::class)]
        public readonly SellerFeedbackSummaryTableEntry $neutral,
        #[WithCast(SellerFeedbackSummaryTableEntryCaster::class)]
        public readonly SellerFeedbackSummaryTableEntry $negative,
        #[WithCast(SellerFeedbackSummaryTableEntryCaster::class)]
        public readonly SellerFeedbackSummaryTableEntry $positive,
    ) {}
}
