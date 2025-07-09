<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class AmazonSellerResponse extends Data
{
    public function __construct(
        /* @var AmazonSellerResult[] $results */
        #[DataCollectionOf(AmazonSellerResult::class)]
        public readonly array $results,
        public readonly PushPullJob $job,
    ) {}
}
