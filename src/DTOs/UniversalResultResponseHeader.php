<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class UniversalResultResponseHeader extends Data
{
    public function __construct(
        public readonly ?string $nel = null,
        public readonly ?string $etag = null,
        public readonly ?string $date = null,
        public readonly ?string $link = null,
        public readonly ?string $vary = null,
        public readonly ?string $x_dc = null,
        public readonly ?string $pragma = null,
        public readonly ?string $cf_ray = null,
        public readonly ?string $server = null,
        public readonly ?string $alt_svc = null,
        public readonly ?string $expires = null,
        public readonly ?string $x_shopid = null,
        public readonly ?string $report_to = null,
        public readonly ?string $sec_ch_ua = null,
        public readonly ?string $x_shardid = null,
        public readonly ?string $powered_by = null,
        public readonly ?string $content_type = null,
        public readonly ?string $x_request_id = null,
        public readonly ?string $cache_control = null,
        public readonly ?string $server_timing = null,
        public readonly ?string $x_firefox_spdy = null,
        public readonly ?string $cf_cache_status = null,
        public readonly ?string $shopify_edge_ip = null,
        public readonly ?string $x_frame_options = null,
        public readonly ?string $content_encoding = null,
        public readonly ?string $content_language = null,
        public readonly ?string $x_xss_protection = null,
        public readonly ?string $speculation_rules = null,
        public readonly ?string $x_akamai_trace_id = null,
        public readonly ?string $x_download_options = null,
        public readonly ?string $remaining_edge_ttl = null,
        public readonly ?string $x_sorting_hat_podid = null,
        public readonly ?string $x_akamai_transformed = null,
        public readonly ?string $x_sorting_hat_shopid = null,
        public readonly ?string $x_content_type_options = null,
        public readonly ?string $content_security_policy = null,
        public readonly ?string $shopify_complexity_score = null,
        public readonly ?string $strict_transport_security = null,
        public readonly ?string $x_oxyserps_content_length = null,
        public readonly ?string $access_control_allow_origin = null,
        public readonly ?string $x_storefront_renderer_rendered = null,
        public readonly ?string $x_permitted_cross_domain_policies = null,
    ) {}
}
