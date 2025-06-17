<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class GoogleSearchRequest extends Data
{
    public function __construct(
        public readonly string $query,
        public readonly ?string $geo_location = null,
        public readonly ?string $user_agent_type = null,
        public readonly ?bool $parse = null,
        public readonly ?bool $render = null,
        public readonly ?array $context = null
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'query' => $this->query,
            'geo_location' => $this->geo_location,
            'user_agent_type' => $this->user_agent_type,
            'parse' => $this->parse,
            'render' => $this->render,
            'context' => $this->context,
        ]);
    }
}
