<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use AlwaysOpen\OxylabsApi\DTOs\Casters\SellerFeedbackSummaryDataEntryCaster;
use AlwaysOpen\OxylabsApi\DTOs\Casters\SellerFeedbackSummaryTableEntryCaster;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class SellerFeedbackSummaryData extends Data
{
    public function __construct(
        #[WithCast(SellerFeedbackSummaryDataEntryCaster::class)]
        public readonly SellerFeedbackSummaryDataEntry $_1_month,
        #[WithCast(SellerFeedbackSummaryDataEntryCaster::class)]
        public readonly SellerFeedbackSummaryDataEntry $_3_month,
        #[WithCast(SellerFeedbackSummaryDataEntryCaster::class)]
        public readonly SellerFeedbackSummaryDataEntry $_12_month,
        #[WithCast(SellerFeedbackSummaryDataEntryCaster::class)]
        public readonly SellerFeedbackSummaryDataEntry $all_time,
    ) {}
}
