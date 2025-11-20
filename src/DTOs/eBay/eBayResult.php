<?php

namespace AlwaysOpen\OxylabsApi\DTOs\eBay;

use AlwaysOpen\OxylabsApi\Traits\Renderable;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class eBayResult extends Data
{
    use Renderable;

    public function __construct(
        public readonly string|eBayResultContent $content,
        public readonly int $page,
        public readonly string $url,
        public readonly string $job_id,
        public readonly bool $is_render_forced,
        public readonly int $status_code,
        public readonly ?string $type = null,
        public readonly ?string $parser_type = null,
        #[WithCast(DateTimeInterfaceCast::class, format: ['Y-m-d H:i:s', 'Y-m-d\TH:i:s\+H:i', 'Y-m-d H:i:s.u'])]
        public readonly ?Carbon $created_at = null,
        #[WithCast(DateTimeInterfaceCast::class, format: ['Y-m-d H:i:s', 'Y-m-d\TH:i:s\+H:i', 'Y-m-d H:i:s.u'])]
        public readonly ?Carbon $updated_at = null,
        public readonly ?string $parser_preset = null,
    ) {}
}
