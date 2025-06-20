<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class AmazonPricingResponse extends Data
{
    public function __construct(
        public readonly array $data
    ) {}

    public static function fromArray(array $data): self
    {
        return new self($data);
    }
}
