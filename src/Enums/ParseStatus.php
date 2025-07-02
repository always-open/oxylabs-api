<?php

namespace AlwaysOpen\OxylabsApi\Enums;

enum ParseStatus: int
{
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
