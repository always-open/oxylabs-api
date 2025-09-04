<?php

exit(var_dump(env('OXYLABS_API_REQUEST_LOGGING_ENABLED', true)));

return [
    'base_url' => env('OXYLAB_API_BASE_URL', 'https://data.oxylabs.io/v1/'), // https://realtime.oxylabs.io/v1
    'username' => env('OXYLAB_API_USERNAME'),
    'password' => env('OXYLAB_API_PASSWORD'),
    'auth_method' => env('OXYLAB_API_AUTH_METHOD', 'basic'),
    'request_logging_enabled' => env('OXYLABS_API_REQUEST_LOGGING_ENABLED', true),
];
