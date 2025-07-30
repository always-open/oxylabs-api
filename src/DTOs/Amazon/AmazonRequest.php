<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use AlwaysOpen\OxylabsApi\Enums\RenderOption;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

class AmazonRequest extends Data
{
    public function __construct(
        public readonly string $source,
        public readonly string $domain,
        public readonly string $url,
        #[WithCast(EnumCast::class)]
        public readonly ?RenderOption $render = null,
        public readonly ?bool $parse = null,
        public readonly ?string $geo_location = null,
        public readonly ?int $pages = null,
        public readonly ?int $start_page = null,
        public readonly ?array $context = null
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'source' => $this->source,
            'domain' => $this->domain,
            'url' => $this->url,
            'parse' => $this->parse,
            'geo_location' => $this->geo_location,
            'context' => $this->context,
            'pages' => $this->pages,
            'render' => $this->render,
            'start_page' => $this->start_page,
        ]);
    }

    public static function generateUrl(
        string $asin,
        ?string $sellerId = null,
        ?string $marketplaceId = null,
        ?string $domain = 'com',
    ): string {
        $domain ??= 'com';
        $url = "https://www.amazon.{$domain}/dp/{$asin}/ref=sr_1_4?";
        if ($sellerId) {
            $url .= "m={$sellerId}&";
        }
        if ($marketplaceId) {
            $url .= "marketplaceID={$marketplaceId}&";
        }

        return "{$url}s=merchant-items&sr=1-4&th=1&psc=1";
    }
}
