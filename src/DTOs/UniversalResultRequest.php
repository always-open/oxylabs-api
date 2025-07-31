<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use AlwaysOpen\OxylabsApi\DTOs\Casters\DashToUnderscoreCaster;
use AlwaysOpen\OxylabsApi\DTOs\Casters\DashToUnderscoreCasterIterable;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class UniversalResultRequest extends Data
{
    public function __construct(
        /* @var Cookie[] $cookies */
        #[DataCollectionOf(Cookie::class)]
        #[WithCast(DashToUnderscoreCasterIterable::class, toLower: true)]
        public readonly null|array $cookies = null,
        #[WithCast(DashToUnderscoreCaster::class, toLower: true)]
        public readonly UniversalResultRequestHeader|null $headers = null,
    ) {}
}
