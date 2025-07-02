<?php

namespace AlwaysOpen\OxylabsApi\Enums;

enum APIStatus : int
{
    case OK = 200;
    case ACCEPTED = 202;
    case NO_CONTENT = 204;
    case MULTIPLE_ERROR_MESSAGES = 400;
    case INVALID_AUTHORIZATION = 401;
    case FORBIDDEN = 403;
    case NOT_FOUND = 404;
    case UNPROCESSABLE_ENTITY = 422;
    case TOO_MANY_REQUESTS = 429;
    case INTERNAL_SERVER_ERROR = 500;
    case TIMEOUT = 524;
    case UNDEFINED_INTERNAL_ERROR = 612;
    case FAULTED_AFTER_TOO_MANY_RETRIES = 613;
}