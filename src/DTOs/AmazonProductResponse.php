<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class AmazonProductResponse extends Data
{
    public function __construct(
        /* @var AmazonProductResult[] $results */
        #[DataCollectionOf(AmazonProductResult::class)]
        public readonly array $results,
        public readonly PushPullJob $job,
    ) {}
}
