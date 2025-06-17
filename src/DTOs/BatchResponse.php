<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class BatchResponse extends Data
{
    public function __construct(
        public readonly int $client_id,
        public readonly array $context,
        public readonly string $created_at,
        public readonly string $domain,
        public readonly string $geo_location,
        public readonly string $id,
        public readonly int $limit,
        public readonly int $pages,
        public readonly string $status,
        /** @var Link[] $_links */
        public readonly ?array $_links = null,
        public readonly ?string $storage_type = null,
        public readonly ?string $storage_url = null,
        public readonly ?string $subdomain = null,
        public readonly ?string $updated_at = null,
        public readonly ?string $user_agent_type = null,
        public readonly ?string $locale = null,
        public readonly ?string $callback_url = null,
    ) {}
}
