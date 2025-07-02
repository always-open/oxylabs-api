<?php

namespace AlwaysOpen\OxylabsApi\Enums;

enum SessionStatus: int
{
    case EXPIRED = 15001;
    case FAILED = 15002;
    case UPDATE_FAILED = 15003;
}
