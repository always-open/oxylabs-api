<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class Link extends Data
{
    public function __construct(
        public readonly string $title,
        public readonly string $url,
    ) {}
}
