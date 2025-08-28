<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Walmart;

use AlwaysOpen\OxylabsApi\DTOs\PushPullJob;
use AlwaysOpen\OxylabsApi\DTOs\Traits\ValidResponse;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class WalmartProductResponse extends Data
{
    use ValidResponse;

    public function __construct(
        /* @var WalmartProductResult[] $results */
        #[DataCollectionOf(WalmartProductResult::class)]
        public readonly ?array $results,
        public readonly ?PushPullJob $job,
    ) {}
}
