<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use AlwaysOpen\OxylabsApi\Enums\RenderOption;
use Spatie\LaravelData\Data;

class GoogleShoppingProductRequest extends Data
{
    public function __construct(
        public readonly string $source,
        public readonly string $domain,
        public readonly string $query,
        public readonly ?bool $parse = null,
        public readonly ?array $context = null,
        public readonly ?RenderOption $render = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'source' => $this->source,
            'domain' => $this->domain,
            'query' => $this->query,
            'parse' => $this->parse,
            'context' => $this->context,
            'render' => $this->render,
        ]);
    }
}
