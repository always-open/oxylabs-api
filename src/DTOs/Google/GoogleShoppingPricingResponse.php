<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use AlwaysOpen\OxylabsApi\DTOs\PushPullJob;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class GoogleShoppingPricingResponse extends Data
{
    public const int MAX_PRICES_PER_PAGE = 20;

    public function __construct(
        /* @var GoogleShoppingPricingResult[] $results */
        #[DataCollectionOf(GoogleShoppingPricingResult::class)]
        public readonly array $results,
        public readonly PushPullJob $job,
    ) {}
}
