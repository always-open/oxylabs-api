<?php

namespace AlwaysOpen\OxylabsApi\Traits;

use AlwaysOpen\OxylabsApi\Enums\ParseStatus as ParseStatusEnum;

trait ParseStatus
{
    /**
     * Whether Oxylabs reported a parse status for this content at all.
     *
     * Oxylabs omits `parse_status_code` entirely whenever its parser never ran
     * (blocked / CAPTCHA / error pages, unsupported page types, raw html mode).
     * That is a different fact from "the parser ran and reported a failure",
     * so callers that care can still tell the two apart.
     */
    public function hasParseStatus(): bool
    {
        return $this->parse_status_code !== null;
    }

    /**
     * Never throws. Resolves to:
     *  - the reported status, when Oxylabs sent a code this SDK models;
     *  - ParseStatus::NOT_REPORTED, when Oxylabs sent no code at all;
     *  - ParseStatus::UNKNOWN, when Oxylabs sent a code we do not model yet.
     */
    public function getParseStatusCode(): ParseStatusEnum
    {
        if ($this->parse_status_code === null) {
            return ParseStatusEnum::NOT_REPORTED;
        }

        return ParseStatusEnum::tryFrom($this->parse_status_code) ?? ParseStatusEnum::UNKNOWN;
    }
}
