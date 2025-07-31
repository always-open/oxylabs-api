<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class Cookie extends Data
{
    public function __construct(
        public readonly string|null $key = null,
        public readonly string|null $path = null,
        public readonly string|null $value = null,
        public readonly string|null $domain = null,
        public readonly bool|null $secure = null,
        public readonly string|null $comment = null,
        public readonly string|null $expires = null,
        public readonly string|null $max_age = null,
        public readonly string|null $version = null,
        public readonly bool|null $httponly = null,
        public readonly string|null $samesite = null,
    ) {}
}
