<?php

namespace AlwaysOpen\OxylabsApi\Traits;

use \AlwaysOpen\OxylabsApi\Enums\ParseStatus as ParseStatusEnum;
trait ParseStatus
{
    public function getParseStatusCode(): ParseStatusEnum
    {
        return ParseStatusEnum::from($this->parse_status_code);
    }
}