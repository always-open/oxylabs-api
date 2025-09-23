<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google\Url;

use AlwaysOpen\OxylabsApi\Traits\Renderable;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class GoogleUrlResult extends Data
{
    use Renderable;

    public const int MAX_PRICES_PER_PAGE = 3;

    public function __construct(
        //@TODO handle parsed results in next version
        public readonly string $content,
        public readonly int $page,
        public readonly string $url,
        public readonly string $job_id,
        public readonly bool $is_render_forced,
        public readonly int $status_code,
        #[WithCast(DateTimeInterfaceCast::class, format: ['Y-m-d H:i:s', 'Y-m-d\TH:i:s\+H:i', 'Y-m-d H:i:s.u'])]
        public readonly ?Carbon $created_at = null,
        #[WithCast(DateTimeInterfaceCast::class, format: ['Y-m-d H:i:s', 'Y-m-d\TH:i:s\+H:i', 'Y-m-d H:i:s.u'])]
        public readonly ?Carbon $updated_at = null,
        public readonly ?string $parser_type = null,
        public readonly ?string $parser_preset = null,
    ) {}

    public function nextPage(): int
    {
        return $this->page + 1;
    }
}
