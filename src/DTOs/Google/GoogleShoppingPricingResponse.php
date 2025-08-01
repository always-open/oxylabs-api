<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use AlwaysOpen\OxylabsApi\DTOs\PushPullJob;
use AlwaysOpen\OxylabsApi\DTOs\Traits\ValidResponse;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class GoogleShoppingPricingResponse extends Data
{
    use ValidResponse;

    public function __construct(
        /* @var GoogleShoppingPricingResult[] $results */
        #[DataCollectionOf(GoogleShoppingPricingResult::class)]
        public readonly array $results,
        public readonly PushPullJob $job,
    ) {}
}
