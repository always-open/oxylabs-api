<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use AlwaysOpen\OxylabsApi\DTOs\PushPullJob;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class AmazonResponse extends Data
{
    public function __construct(
        /* @var AmazonResult[] $results */
        #[DataCollectionOf(AmazonResult::class)]
        public readonly array $results,
        public readonly PushPullJob $job,
    ) {}
}
