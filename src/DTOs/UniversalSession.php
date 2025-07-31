<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class UniversalSession extends Data
{
    public function __construct(
        public readonly mixed $id,
        public readonly mixed $expires_at,
        public readonly mixed $remaining,
    ) {}
}
