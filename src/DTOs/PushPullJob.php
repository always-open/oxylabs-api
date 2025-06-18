<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class PushPullJob extends Data
{
    public function __construct(
        public readonly int $client_id,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly Carbon $created_at,
        public readonly string $domain,
        public readonly string $id,
        public readonly int $limit,
        public readonly int $pages,
        public readonly bool $parse,
        public readonly bool $xhr,
        public readonly bool $markdown,
        public readonly string $source,
        public readonly int $start_page,
        public readonly string $status,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly Carbon $updated_at,
        public readonly ?string $callback_url = null,
        public readonly ?array $context = null,
        public readonly ?string $geo_location = null,
        public readonly ?string $locale = null,
        public readonly ?string $parse_type = null,
        public readonly ?string $parse_preset = null,
        public readonly ?string $parsing_instructions = null,
        public readonly ?string $browser_instructions = null,
        public readonly ?string $render = null,
        public readonly ?string $url = null,
        public readonly ?string $query = null,
        public readonly ?string $storage_type = null,
        public readonly ?string $storage_url = null,
        public readonly ?string $subdomain = null,
        public readonly ?string $content_encoding = null,
        public readonly ?string $user_agent_type = null,
        public readonly array|string|null $session_info = null,
        public readonly ?array $statuses = null,
        public readonly ?string $proxy_plan = null,
        public readonly ?string $client_notes = null,
        /* @var ResultLink[]|null */
        public readonly ?array $_links = null,
    ) {}

    public function isDone() : bool
    {
        return strtolower($this->status) === 'done';
    }

    public function isPending() : bool
    {
        return strtolower($this->status) === 'pending';
    }

    public function isFaulted() : bool
    {
        return strtolower($this->status) === 'faulted';
    }
}
