<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Casters;

use AlwaysOpen\OxylabsApi\DTOs\SellerFeedbackSummaryTableEntry;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class SellerFeedbackSummaryTableEntryCaster implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        return new SellerFeedbackSummaryTableEntry(
            $value['30_days'],
            $value['90_days'],
            $value['all_time'],
            $value['12_months'],
        );
    }
}
