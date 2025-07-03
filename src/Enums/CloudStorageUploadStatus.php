<?php

namespace AlwaysOpen\OxylabsApi\Enums;

enum CloudStorageUploadStatus: int
{
    case UNEXPECTED_EXCEPTION = 10001;
    case UPLOAD_SUCCESS = 13000;
    case UPLOAD_FAILED = 13001;
    case NO_SUCH_PATH = 13102;
    case ACCESS_DENIED = 13103;
}
