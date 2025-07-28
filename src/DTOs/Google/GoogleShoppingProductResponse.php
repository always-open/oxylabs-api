<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use AlwaysOpen\OxylabsApi\DTOs\PushPullJob;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class GoogleShoppingProductResponse extends Data
{
    public function __construct(
        /* @var GoogleShoppingProductResult[] $results */
        #[DataCollectionOf(GoogleShoppingProductResult::class)]
        public readonly DataCollection $results,
        public readonly PushPullJob $job,
    ) {}
}
