<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class BrowserInstruction extends Data
{
    public function __construct(
        public readonly string $type,
        /* @var BrowserInstructionSelector[] $selector */
        #[DataCollectionOf(BrowserInstructionSelector::class)]
        public readonly ?array $selector = null,
        public readonly ?int $wait_time_s = null,
        public readonly ?int $timeout_s = null,
        public readonly ?string $on_error = null,
        public readonly ?int $x = null,
        public readonly ?int $y = null,
        public readonly ?string $filter = null,
    ) {}
}
