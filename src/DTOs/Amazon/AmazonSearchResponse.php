<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Spatie\LaravelData\Data;

class AmazonSearchResponse extends Data
{
    public function __construct(
        public readonly array $data
    ) {}

    public static function fromArray(array $data): self
    {
        return new self($data);
    }
}
