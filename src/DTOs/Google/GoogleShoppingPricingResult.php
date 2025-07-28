<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use AlwaysOpen\OxylabsApi\Traits\Renderable;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class GoogleShoppingPricingResult extends Data
{
    use Renderable;

    public const int MAX_PRICES_PER_PAGE = 20;

    public function __construct(
        public readonly GoogleShoppingPricingResultContent|string $content,
        public readonly int $page,
        public readonly string $url,
        public readonly string $job_id,
        public readonly bool $is_render_forced,
        public readonly int $status_code,
        public readonly string $parser_type,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $created_at = null,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $updated_at = null,
        public readonly ?string $parser_preset = null,
    ) {}

    public function hasMaxResults(): bool
    {
        return count($this->content->pricing) >= self::MAX_PRICES_PER_PAGE;
    }

    public function nextPage(): int
    {
        return $this->page + 1;
    }
}
