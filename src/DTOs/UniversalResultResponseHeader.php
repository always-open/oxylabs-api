<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class UniversalResultResponseHeader extends Data
{
    public function __construct(
        public readonly ?string $date = null,
        public readonly ?string $vary = null,
        public readonly ?string $pragma = null,
        public readonly ?string $expires = null,
        public readonly ?string $content_type = null,
        public readonly ?string $x_request_id = null,
        public readonly ?string $cache_control = null,
        public readonly ?string $server_timing = null,
        public readonly ?string $x_frame_options = null,
        public readonly ?string $content_encoding = null,
        public readonly ?string $x_akamai_trace_id = null,
        public readonly ?string $remaining_edge_ttl = null,
        public readonly ?string $x_akamai_transformed = null,
        public readonly ?string $x_content_type_options = null,
        public readonly ?string $strict_transport_security = null,
        public readonly ?string $x_oxyserps_content_length = null,
    ) {}
}
