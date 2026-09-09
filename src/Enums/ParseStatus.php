<?php

namespace AlwaysOpen\OxylabsApi\Enums;

enum ParseStatus: int
{
    /**
     * Sentinel for "Oxylabs reported no parse status at all".
     *
     * Deliberately outside the vendor 120xx numbering space: it is our
     * statement about a missing field, never a code Oxylabs sent us.
     */
    case NOT_REPORTED = 0;

    case SUCCESS = 12000;
    case FAILURE_COULD_NOT_PARSE = 12002;
    case NOT_SUPPORTED = 12003;
    case PARTIAL_SUCCESS_WITH_MISSING = 12004;
    case PARTIAL_SUCCESS_WITH_DEFAULTS = 12005;
    case FAILURE_UNEXPECTED = 12006;
    case UNKNOWN = 12007;
    case FAILURE_CONTENT_MISSING = 12008;
    case FAILURE_PRODUCT_NOT_FOUND = 12009;

}
