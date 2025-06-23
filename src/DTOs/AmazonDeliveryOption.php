<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class AmazonDeliveryOption extends Data
{
    public function __construct(
        public readonly AmazonDeliveryOptionDate $date,
        public readonly string $type,
    ) {}
}
