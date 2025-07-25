<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use AlwaysOpen\OxylabsApi\DTOs\PushPullJob;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class GoogleShoppingPricingResponse extends Data
{
    public function __construct(
        #[DataCollectionOf(GoogleShoppingPricingResult::class)]
        public readonly DataCollection $results,
        public readonly PushPullJob $job,
    ) {}
}
