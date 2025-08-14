<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use AlwaysOpen\OxylabsApi\DTOs\Casters\DashToUnderscoreCaster;
use AlwaysOpen\OxylabsApi\DTOs\Casters\DashToUnderscoreCasterIterable;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class UniversalResultResponse extends Data
{
    public function __construct(
        /* @var Cookie[] $cookies */
        #[DataCollectionOf(Cookie::class)]
        #[WithCast(DashToUnderscoreCasterIterable::class, toLower: true)]
        public readonly ?array $cookies = null,
        public readonly ?array $headers = null,
    ) {}
}
