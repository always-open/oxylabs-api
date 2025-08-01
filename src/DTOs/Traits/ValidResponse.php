<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Traits;

trait ValidResponse
{
    public function isValid(): bool
    {
        return $this->results !== null && $this->job !== null;
    }
}
