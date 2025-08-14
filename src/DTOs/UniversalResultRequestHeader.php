<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class UniversalResultRequestHeader extends Data
{
    public function __construct(
        public readonly ?string $accept = null,
        public readonly ?string $te = null,
        public readonly ?string $referer = null,
        public readonly ?string $user_agent = null,
        public readonly ?string $sec_fetch_dest = null,
        public readonly ?string $sec_fetch_mode = null,
        public readonly ?string $sec_fetch_site = null,
        public readonly ?string $sec_ch_ua = null,
        public readonly ?string $sec_ch_ua_mobile = null,
        public readonly ?string $sec_ch_ua_platform = null,
        public readonly ?string $sec_fetch_user = null,
        public readonly ?string $accept_encoding = null,
        public readonly ?string $accept_language = null,
        public readonly ?string $upgrade_insecure_requests = null,
    ) {}
}
