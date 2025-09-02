<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use AlwaysOpen\OxylabsApi\Traits\ParseStatus;
use Spatie\LaravelData\Data;

class UniversalResultContent extends Data
{
    use ParseStatus;

    public function __construct(
        public readonly ?int $parse_status_code,
    ) {}
}
