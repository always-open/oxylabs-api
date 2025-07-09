<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Casters;

use AlwaysOpen\OxylabsApi\DTOs\SellerFeedbackSummaryData;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class SellerFeedbackSummaryDataCaster implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        return SellerFeedbackSummaryData::from([
            '_1_month' => $value['1_month'],
            '_3_month' => $value['3_month'],
            '_12_month' => $value['12_month'],
            'all_time' => $value['all_time'],
        ]);
    }
}
