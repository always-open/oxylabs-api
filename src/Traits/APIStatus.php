<?php

namespace AlwaysOpen\OxylabsApi\Traits;

use AlwaysOpen\OxylabsApi\Enums\APIStatus as APIStatusEnum;

trait APIStatus
{
    public function getParseStatusCode(): APIStatusEnum
    {
        return APIStatusEnum::from($this->status_code);
    }
}
