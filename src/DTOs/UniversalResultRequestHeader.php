<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class UniversalResultRequestHeader extends Data
{
    public function __construct(
        public readonly string|null $accept = null,
        public readonly string|null $user_agent = null,
        public readonly string|null $sec_fetch_dest = null,
        public readonly string|null $sec_fetch_mode = null,
        public readonly string|null $sec_fetch_site = null,
        public readonly string|null $accept_encoding = null,
        public readonly string|null $accept_language = null,
    ) {}
}
