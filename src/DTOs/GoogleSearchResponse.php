<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class GoogleSearchResponse extends Data
{
    protected array $results;
    protected ?array $parsed_content = null;
    protected ?array $context = null;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->results = $data['results'] ?? [];
        $instance->parsed_content = $data['parsed_content'] ?? null;
        $instance->context = $data['context'] ?? null;
        return $instance;
    }

    public function getResults(): array
    {
        return $this->results;
    }

    public function getParsedContent(): ?array
    {
        return $this->parsed_content;
    }

    public function getContext(): ?array
    {
        return $this->context;
    }
} 