<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class AmazonProductResponse extends Data
{
    public function __construct(
        /* @var AmazonProductResult[] $results */
        public readonly array $results,
        public readonly PushPullJob $job,
    ) {}
}
