<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Data;

class AmazonSearchRequest extends Data
{
    public function __construct(
        public readonly string $source,
        public readonly string $domain,
        public readonly string $query,
        public readonly ?array $parse = null,
        public readonly ?array $context = null,
        public readonly ?int $startPage = null,
        public readonly ?int $endPage = null,
        public readonly ?string $sort = null,
        public readonly ?string $category = null,
        public readonly ?string $locale = null
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'source' => $this->source,
            'domain' => $this->domain,
            'query' => $this->query,
            'parse' => $this->parse,
            'context' => $this->context,
            'start_page' => $this->startPage,
            'end_page' => $this->endPage,
            'sort' => $this->sort,
            'category' => $this->category,
            'locale' => $this->locale,
        ]);
    }
}
