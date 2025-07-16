<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class AmazonSalesRank extends Data
{
    public function __construct(
        public readonly int $rank,
        #[DataCollectionOf(AmazonCategory::class)]
        public readonly ?array $ladder = null,
    ) {}
}
