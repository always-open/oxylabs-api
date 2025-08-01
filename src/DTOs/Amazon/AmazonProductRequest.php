<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use AlwaysOpen\OxylabsApi\Enums\RenderOption;
use Spatie\LaravelData\Data;

class AmazonProductRequest extends Data
{
    public function __construct(
        public readonly string $source,
        public readonly string $domain,
        public readonly string $asin,
        public readonly ?bool $parse = null,
        public readonly ?array $context = null,
        public readonly ?RenderOption $render = null,
    ) {}

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
