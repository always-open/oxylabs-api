<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class AmazonDeliveryOptionDate extends Data
{
    public function __construct(
        public readonly string $by,
    ) {}
}
