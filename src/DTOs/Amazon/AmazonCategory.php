<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Data;

class AmazonCategory extends Data
{
    public function __construct(
        public readonly string $url,
        public readonly string $name,
    ) {}
}
