<?php

namespace AlwaysOpen\OxylabsApi\DTOs\eBay;

use AlwaysOpen\OxylabsApi\DTOs\PushPullJob;
use AlwaysOpen\OxylabsApi\DTOs\Traits\ValidResponse;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class eBayResponse extends Data
{
    use ValidResponse;

    public function __construct(
        /* @var eBayResult[] $results */
        #[DataCollectionOf(eBayResult::class)]
        public readonly ?array $results,
        public readonly ?PushPullJob $job,
    ) {}
}
