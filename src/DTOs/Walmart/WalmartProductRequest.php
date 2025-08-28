<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Walmart;

use AlwaysOpen\OxylabsApi\Enums\RenderOption;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

class WalmartProductRequest extends Data
{
    public function __construct(
        public readonly string $source,
        public readonly string $domain,
        public readonly string $product_id,
        #[WithCast(EnumCast::class)]
        public readonly ?RenderOption $render = null,
        public readonly ?bool $parse = null,
        public readonly ?string $delivery_zip = null,
        public readonly ?string $store_id = null,
        public readonly ?string $callback_url = null,
        public readonly ?string $user_agent_type = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'source' => $this->source,
            'domain' => $this->domain,
            'product_id' => $this->product_id,
            'render' => $this->render,
            'parse' => $this->parse,
            'delivery_zip' => $this->delivery_zip,
            'store_id' => $this->store_id,
            'callback_url' => $this->callback_url,
            'user_agent_type' => $this->user_agent_type,
        ]);
    }

}
