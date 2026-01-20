<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class BrowserInstruction extends Data
{
    public function __construct(
        public readonly string $type,
        public readonly ?BrowserInstructionSelector $selector = null,
        public readonly ?int $wait_time_s = null,
        public readonly ?int $timeout_s = null,
        public readonly ?string $on_error = null,
        public readonly ?int $x = null,
        public readonly ?int $y = null,
        public readonly ?string $filter = null,
    ) {}


    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'selector' => $this->selector?->toArray(),
            'wait_time_s' => $this->wait_time_s,
            'timeout_s' => $this->timeout_s,
            'on_error' => $this->on_error,
            'x' => $this->x,
            'y' => $this->y,
            'filter' => $this->filter,
        ]);
    }
}
