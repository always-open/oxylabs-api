<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use AlwaysOpen\OxylabsApi\Enums\RenderOption;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class BatchRequest extends Data
{
    /**
     * @throws \Exception
     */
    public function __construct(
        public readonly string $source,
        public readonly string $domain,
        public readonly ?array $query = null,
        public readonly ?array $url = null,
        public readonly bool $parse = true,
        public readonly ?int $start_page = null,
        public readonly ?int $pages = null,
        public readonly ?string $callback_url = null,
        public readonly ?string $geo_location = null,
        public readonly ?array $context = null,
        public readonly ?RenderOption $render = null,
        /* @var BrowserInstruction[] $browser_instructions */
        #[DataCollectionOf(BrowserInstruction::class)]
        public readonly ?array $browser_instructions = null,
    ) {
        if (
            ($this->query === null && $this->url === null)
            || ($this->query !== null && $this->url !== null)
        ) {
            throw new \Exception('Query or URL must be set, but not both');
        }

    }

    public function toArray(): array
    {
        return array_filter([
            'source' => $this->source,
            'domain' => $this->domain,
            'query' => $this->query,
            'url' => $this->url,
            'start_page' => $this->start_page,
            'pages' => $this->pages,
            'parse' => $this->parse,
            'callback_url' => $this->callback_url,
            'geo_location' => $this->geo_location,
            'context' => $this->context,
            'render' => $this->render,
            'browser_instructions' => $this->browser_instructions,
        ]);
    }
}
