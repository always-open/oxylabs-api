<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class UniversalResultResponseHeader extends Data
{
    public function __construct(
        public readonly string|null $date = null,
        public readonly string|null $vary = null,
        public readonly string|null $pragma = null,
        public readonly string|null $expires = null,
        public readonly string|null $content_type = null,
        public readonly string|null $x_request_id = null,
        public readonly string|null $cache_control = null,
        public readonly string|null $server_timing = null,
        public readonly string|null $x_frame_options = null,
        public readonly string|null $content_encoding = null,
        public readonly string|null $x_akamai_trace_id = null,
        public readonly string|null $remaining_edge_ttl = null,
        public readonly string|null $x_akamai_transformed = null,
        public readonly string|null $x_content_type_options = null,
        public readonly string|null $strict_transport_security = null,
        public readonly string|null $x_oxyserps_content_length = null,
    )
    {}
}
