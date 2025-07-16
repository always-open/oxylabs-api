<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class AmazonCategories extends Data
{
    public function __construct(
        #[DataCollectionOf(AmazonCategory::class)]
        public readonly ?array $ladder = null,
    ) {}
}
