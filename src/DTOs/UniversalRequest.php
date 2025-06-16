<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

class UniversalRequest extends BaseRequest
{
    protected string $url;

    protected ?string $geo_location = null;

    protected ?string $user_agent_type = null;

    protected ?bool $parse = null;

    protected ?bool $render = null;

    protected ?array $context = null;

    public function __construct(
        string $url,
        ?string $geo_location = null,
        ?string $user_agent_type = null,
        ?bool $parse = null,
        ?bool $render = null,
        ?array $context = null
    ) {
        $this->url = $url;
        $this->geo_location = $geo_location;
        $this->user_agent_type = $user_agent_type;
        $this->parse = $parse;
        $this->render = $render;
        $this->context = $context;
    }

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
