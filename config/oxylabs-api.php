<?php

return [
    'base_url' => env('OXYLAB_API_BASE_URL', 'https://api.oxylabs.io/v1'),
    'username' => env('OXYLAB_API_USERNAME'),
    'password' => env('OXYLAB_API_PASSWORD'),
    'auth_method' => env('OXYLAB_API_AUTH_METHOD', 'basic'),
];
