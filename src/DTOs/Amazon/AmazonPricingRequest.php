<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use AlwaysOpen\OxylabsApi\Enums\RenderOption;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

class AmazonPricingRequest extends Data
{
    public function __construct(
        public readonly string $source,
        public readonly string $domain,
        public readonly string $asin,
        #[WithCast(EnumCast::class)]
        public readonly ?RenderOption $render = null,
        public readonly ?array $parse = null,
        public readonly ?int $pages = null,
        public readonly ?int $start_page = null,
        public readonly ?array $context = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'source' => $this->source,
            'domain' => $this->domain,
            'asin' => $this->asin,
            'parse' => $this->parse,
            'context' => $this->context,
            'pages' => $this->pages,
            'start_page' => $this->start_page,
        ]);
    }
}
