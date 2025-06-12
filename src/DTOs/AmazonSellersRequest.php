<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

class AmazonSellersRequest
{
    public function __construct(
        public readonly string $source,
        public readonly string $domain,
        public readonly string $query,
        public readonly ?array $parse = null,
        public readonly ?array $context = null
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'source' => $this->source,
            'domain' => $this->domain,
            'query' => $this->query,
            'parse' => $this->parse,
            'context' => $this->context,
        ]);
    }
}
