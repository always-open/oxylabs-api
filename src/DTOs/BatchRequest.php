<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class BatchRequest extends Data
{
    /**
     * @throws \Exception
     */
    public function __construct(
        public readonly string $source,
        public readonly ?array $query,
        public readonly ?array $url,
        public readonly string $asin,
        public readonly bool $parse = true,
        public readonly ?string $callback_url = null,
        public readonly ?string $geo_location = null,
        public readonly ?array $context = null,
    ) {
        if (
            ($this->query === null && $this->url === null)
            || ($this->query !== null && $this->url !== null)
        ) {
            throw new \Exception('Query or URL must be set, but not both');
        }

    }

    public function toArray(): array
    {
        return array_filter([
            'source' => $this->source,
            'domain' => $this->domain,
            'asin' => $this->asin,
            'parse' => $this->parse,
            'context' => $this->context,
        ]);
    }
}
