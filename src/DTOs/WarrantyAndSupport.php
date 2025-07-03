<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class WarrantyAndSupport extends Data
{
    public function __construct(
        public readonly string $description,
        /* @var Link[] $links */
        #[DataCollectionOf(Link::class)]
        public readonly array $links,
    ) {}
}
