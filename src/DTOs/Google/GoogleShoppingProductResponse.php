<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class GoogleShoppingProductResponse extends Data
{
    public function __construct(
        #[DataCollectionOf(GoogleShoppingProductResult::class)]
        public readonly DataCollection $results,
        public readonly GoogleShoppingProductJob $job,
    ) {}
}
