<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class UniversalResponse extends Data
{
    public function __construct(
        /* @var UniversalResult[] $results */
        #[DataCollectionOf(UniversalResult::class)]
        public readonly array $results,
        public readonly PushPullJob $job,
    ) {}
}
