<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use AlwaysOpen\OxylabsApi\DTOs\PushPullJob;
use AlwaysOpen\OxylabsApi\DTOs\Traits\ValidResponse;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class AmazonProductResponse extends Data
{
    use ValidResponse;

    public function __construct(
        /* @var AmazonProductResult[] $results */
        #[DataCollectionOf(AmazonProductResult::class)]
        public readonly array|null $results,
        public readonly PushPullJob|null $job,
    ) {}
}
