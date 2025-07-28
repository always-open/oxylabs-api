<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class AmazonCategories extends Data
{
    public function __construct(
        /* @var null|AmazonCategory[] $ladder */
        #[DataCollectionOf(AmazonCategory::class)]
        public readonly ?array $ladder = null,
    ) {}
}
