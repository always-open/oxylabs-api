<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class AmazonSellersRequest extends Data
{
    public function __construct(
        public readonly string $source,
        public readonly string $query,
        public readonly ?string $domain = null,
        public readonly ?array $parse = null,
        public readonly ?array $context = null
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'source' => $this->source,
            'query' => $this->query,
            'domain' => $this->domain,
            'parse' => $this->parse,
            'context' => $this->context,
        ]);
    }
}
