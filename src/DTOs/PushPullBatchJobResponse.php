<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class PushPullBatchJobResponse extends Data
{
    public function __construct(
        #[DataCollectionOf(PushPullJobResponse::class)]
        public readonly array $queries,
    ) {}
}
