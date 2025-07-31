<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use AlwaysOpen\OxylabsApi\Traits\Renderable;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class UniversalResult extends Data
{
    use Renderable;

    public function __construct(
        public readonly string $content,
        public readonly int $page,
        public readonly string $url,
        public readonly string $job_id,
        public readonly bool $is_render_forced,
        public readonly int $status_code,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $created_at = null,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $updated_at = null,
        public readonly ?UniversalSession $session_info = null,
        public readonly ?UniversalResultRequest $_request = null,
        public readonly ?UniversalResultResponse $_response = null,
    ) {}
}
