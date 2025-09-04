<?php

namespace AlwaysOpen\OxylabsApi\Models;

use AlwaysOpen\RequestLogger\Models\RequestLogBaseModel;

/**
 * AlwaysOpen\OxylabsApi\Models\OxylabsApiRequestLogger
 *
 * @property string|null          $path
 * @property string|null          $params
 * @property string               $http_method
 * @property int|null             $response_code
 * @property array|string|null    $body
 * @property array|string|null    $request_headers
 * @property array|string|null    $response
 * @property array|string|null    $response_headers
 * @property string|null          $exception
 * @property \Carbon\Carbon|null  $occurred_at
 */
class OxylabsApiRequestLogger extends RequestLogBaseModel
{
    protected $table = 'oxylabs_api_request_logger';
}
