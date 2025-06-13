<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

class TargetUrlsResponse
{
    public function __construct(
        public readonly array $data
    ) {}

    public static function fromArray(array $data): self
    {
        return new self($data);
    }
}
