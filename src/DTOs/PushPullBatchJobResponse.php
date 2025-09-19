<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use AlwaysOpen\OxylabsApi\Traits\Headers;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class PushPullBatchJobResponse extends Data
{
    use Headers;

    public function __construct(
        /* @var PushPullJobResponse[] $queries */
        #[DataCollectionOf(PushPullJobResponse::class)]
        public readonly array $queries,
    ) {}
}
