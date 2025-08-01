<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use AlwaysOpen\OxylabsApi\DTOs\PushPullJob;
use AlwaysOpen\OxylabsApi\DTOs\Traits\ValidResponse;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class AmazonResponse extends Data
{
    use ValidResponse;

    public function __construct(
        /* @var AmazonResult[] $results */
        #[DataCollectionOf(AmazonResult::class)]
        public readonly array|null $results,
        public readonly PushPullJob|null $job,
    ) {}
}
