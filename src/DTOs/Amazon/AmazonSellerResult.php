<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class AmazonSellerResult extends Data
{
    public function __construct(
        public readonly AmazonSellerResultContent $content,
        public readonly int $page,
        public readonly string $url,
        public readonly string $job_id,
        public readonly int $status_code,
        public readonly string $parser_type,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $created_at = null,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $updated_at = null,
    ) {}
}
