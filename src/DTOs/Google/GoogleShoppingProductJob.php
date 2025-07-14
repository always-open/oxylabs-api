<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use AlwaysOpen\OxylabsApi\DTOs\ContextItem;
use AlwaysOpen\OxylabsApi\DTOs\Link;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class GoogleShoppingProductJob extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly int $client_id,
        #[DataCollectionOf(ContextItem::class)]
        public readonly DataCollection $context,
        public readonly string $domain,
        public readonly string $source,
        public readonly string $status,
        public readonly int $limit,
        public readonly int $pages,
        public readonly bool $parse,
        public readonly string $query,
        public readonly int $start_page,
        public readonly string $subdomain,
        public readonly string $content_encoding,
        public readonly string $user_agent_type,
        #[DataCollectionOf(Link::class)]
        public readonly DataCollection $_links,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $created_at = null,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $updated_at = null,
        public readonly ?string $callback_url = null,
        public readonly ?string $geo_location = null,
        public readonly ?string $locale = null,
        public readonly ?string $parser_type = null,
        public readonly ?string $parser_preset = null,
        public readonly ?string $parsing_instructions = null,
        public readonly ?string $browser_instructions = null,
        public readonly ?string $render = null,
        public readonly ?bool $xhr = null,
        public readonly ?bool $markdown = null,
        public readonly ?string $url = null,
        public readonly ?string $storage_type = null,
        public readonly ?string $storage_url = null,
        public readonly ?string $session_info = null,
        public readonly ?array $statuses = null,
        public readonly ?string $client_notes = null,
    ) {}
}
