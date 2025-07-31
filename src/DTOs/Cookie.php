<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class Cookie extends Data
{
    public function __construct(
        public readonly ?string $key = null,
        public readonly ?string $path = null,
        public readonly ?string $value = null,
        public readonly ?string $domain = null,
        public readonly ?bool $secure = null,
        public readonly ?string $comment = null,
        public readonly ?string $expires = null,
        public readonly ?string $max_age = null,
        public readonly ?string $version = null,
        public readonly ?bool $httponly = null,
        public readonly ?string $samesite = null,
    ) {}
}
