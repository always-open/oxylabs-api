<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Data;

class AmazonVariation extends Data
{
    public function __construct(
        public readonly string $asin,
        public readonly bool $selected,
        public readonly array $dimensions,
    ) {}
}
