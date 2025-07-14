<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\DataCollectionOf;

class GoogleShoppingProductResponse extends Data
{
    public function __construct(
        #[DataCollectionOf(GoogleShoppingProductResult::class)]
        public readonly DataCollection $results,
        public readonly GoogleShoppingProductJob $job,
    ) {}
}