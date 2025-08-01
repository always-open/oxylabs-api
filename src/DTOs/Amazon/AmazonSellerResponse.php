<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use AlwaysOpen\OxylabsApi\DTOs\PushPullJob;
use AlwaysOpen\OxylabsApi\DTOs\Traits\ValidResponse;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class AmazonSellerResponse extends Data
{
    use ValidResponse;

    public function __construct(
        /* @var AmazonSellerResult[] $results */
        #[DataCollectionOf(AmazonSellerResult::class)]
        public readonly array $results,
        public readonly PushPullJob $job,
    ) {}
}
