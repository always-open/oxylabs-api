<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class AmazonDeliveryDetail extends Data
{
    public function __construct(
        public readonly AmazonDeliveryDetailDate $date,
        public readonly string $type,
    ) {}
}
