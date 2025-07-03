<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class PushPullBatchJobResponse extends Data
{
    public function __construct(
        /* @var PushPullJobResponse[] $queries */
        #[DataCollectionOf(PushPullJobResponse::class)]
        public readonly array $queries,
    ) {}
}
