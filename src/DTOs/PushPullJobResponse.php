<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class PushPullJobResponse extends Data
{
    public function __construct(
        public readonly int $client_id,
        public readonly array $context,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly string $created_at,
        public readonly string $domain,
        public readonly string $geo_location,
        public readonly string $id,
        public readonly int $limit,
        public readonly int $pages,
        public readonly string $status,
        /** @var ResultLink[] $_links */
        public readonly ?array $_links = null,
        public readonly ?string $storage_type = null,
        public readonly ?string $storage_url = null,
        public readonly ?string $subdomain = null,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?string $updated_at = null,
        public readonly ?string $user_agent_type = null,
        public readonly ?string $locale = null,
        public readonly ?string $callback_url = null,
        public readonly ?string $client_notes = null,
        public readonly array|int|null $statuses = null,
        /* @var ResultLink[]|null */
        public readonly ?array $links = null,
    ) {}
}
