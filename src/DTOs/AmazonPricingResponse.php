<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class AmazonPricingResponse extends Data
{
    public function __construct(
        #[DataCollectionOf(AmazonPricingResult::class)]
        public readonly array $results,
        public readonly PushPullJob $job,
    ) {}
}
