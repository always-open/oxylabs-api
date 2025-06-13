<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

class ShowcaseRequest
{
    public function __construct(
        public readonly string $source,
        public readonly string $url,
        public readonly ?string $userAgentType = null,
        public readonly ?string $geoLocation = null,
        public readonly ?array $context = null
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'source' => $this->source,
            'url' => $this->url,
            'user_agent_type' => $this->userAgentType,
            'geo_location' => $this->geoLocation,
            'context' => $this->context,
        ]);
    }
}
