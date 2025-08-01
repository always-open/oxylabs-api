<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Traits;

use Spatie\LaravelData\Data;

trait ValidResponse
{
    public function isValid(): bool
    {
        return $this->results !== null && $this->job !== null;
    }
}
