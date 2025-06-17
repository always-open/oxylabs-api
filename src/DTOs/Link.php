<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class Link extends Data
{
    public function __construct(
        public readonly string $rel,
        public readonly string $href,
        public readonly string $method,
    ) {}
}
