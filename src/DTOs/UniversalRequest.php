<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use AlwaysOpen\OxylabsApi\Enums\RenderOption;
use Spatie\LaravelData\Data;

class UniversalRequest extends Data
{
    public function __construct(
        public readonly string $url,
        public readonly ?string $geo_location = null,
        public readonly ?string $user_agent_type = null,
        public readonly ?bool $parse = null,
        public readonly ?RenderOption $render = null,
        public readonly ?array $context = null,
        //        public readonly ?string $callback_url = null,
        //        public readonly ?string $storage_type = null,
        //        public readonly ?string $storage_url = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'url' => $this->url,
            'geo_location' => $this->geo_location,
            'user_agent_type' => $this->user_agent_type,
            'parse' => $this->parse,
            'render' => $this->render,
            'context' => $this->context,
        ]);
    }
}
