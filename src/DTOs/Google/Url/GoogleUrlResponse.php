<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google\Url;

use AlwaysOpen\OxylabsApi\DTOs\PushPullJob;
use AlwaysOpen\OxylabsApi\DTOs\Traits\ValidResponse;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class GoogleUrlResponse extends Data
{
    use ValidResponse;

    public function __construct(
        /* @var GoogleUrlResult[] $results */
        #[DataCollectionOf(GoogleUrlResult::class)]
        public readonly ?array $results = null,
        public readonly ?PushPullJob $job = null,
    ) {}
}
