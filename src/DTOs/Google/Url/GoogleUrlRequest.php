<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google\Url;

use AlwaysOpen\OxylabsApi\Enums\RenderOption;
use Spatie\LaravelData\Data;

class GoogleUrlRequest extends Data
{
    public function __construct(
        public readonly string $source,
        public readonly string $domain,
        public readonly string $query,
        public readonly ?RenderOption $render = null,
        public readonly ?int $start_page = null,
        public readonly ?int $pages = null,
        public readonly ?bool $parse = null,
        public readonly ?array $context = null
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'source' => $this->source,
            'domain' => $this->domain,
            'query' => $this->query,
            'parse' => $this->parse,
            'context' => $this->context,
            'start_page' => $this->start_page,
            'pages' => $this->pages,
            'render' => $this->render,
        ]);
    }
}
