<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class PushPullBatchJobResponse extends Data
{
    public function __construct(
        /* @var PushPullJobResponse[] */
        public readonly array $queries,
    ) {}
}
