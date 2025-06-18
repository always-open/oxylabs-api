<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class ContextItem extends Data
{
    public function __construct(
        public readonly string $key,
        public readonly ?string $value = null,
    ) {}
}
