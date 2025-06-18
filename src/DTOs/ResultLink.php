<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class ResultLink extends Data
{
    public function __construct(
        public readonly string $rel,
        public readonly string $method,
        public readonly ?string $href = null,
        public readonly ?array $href_list = null,
    ) {}
}
