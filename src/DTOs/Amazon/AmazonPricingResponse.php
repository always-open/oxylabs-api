<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use AlwaysOpen\OxylabsApi\DTOs\PushPullJob;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class AmazonPricingResponse extends Data
{
    public function __construct(
        /* @var AmazonPricingResult[] $results */
        #[DataCollectionOf(AmazonPricingResult::class)]
        public readonly array $results,
        public readonly PushPullJob $job,
    ) {}
}
