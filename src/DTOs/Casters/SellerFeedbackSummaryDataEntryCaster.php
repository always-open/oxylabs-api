<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Casters;

use AlwaysOpen\OxylabsApi\DTOs\SellerFeedbackSummaryDataEntry;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class SellerFeedbackSummaryDataEntryCaster implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        return new SellerFeedbackSummaryDataEntry(
            $value['count'],
            $value['1_star'],
            $value['2_star'],
            $value['3_star'],
            $value['4_star'],
            $value['5_star'],
        );
    }
}
