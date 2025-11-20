<?php

namespace AlwaysOpen\OxylabsApi\DTOs\eBay;

use AlwaysOpen\OxylabsApi\Enums\RenderOption;
use Spatie\LaravelData\Data;

class UrlRequest extends Data
{
    public function __construct(
        public readonly string $url,
        public readonly ?string $user_agent_type = null,
        public readonly ?RenderOption $render = null,
        //        public readonly ?string $callback_url = null,
        //        public readonly ?string $storage_type = null,
        //        public readonly ?string $storage_url = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'url' => $this->url,
            'user_agent_type' => $this->user_agent_type,
            'render' => $this->render,
        ]);
    }
}
