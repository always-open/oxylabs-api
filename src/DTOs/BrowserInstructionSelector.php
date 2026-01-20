<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class BrowserInstructionSelector extends Data
{
    public function __construct(
        public readonly ?string $type = null,
        public readonly ?string $value = null,
    ) {}
}
