<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use AlwaysOpen\OxylabsApi\DTOs\Traits\ValidResponse;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class UniversalResponse extends Data
{
    use ValidResponse;

    public function __construct(
        /* @var UniversalResult[] $results */
        #[DataCollectionOf(UniversalResult::class)]
        public readonly ?array $results,
        public readonly ?PushPullJob $job,
    ) {}
}
