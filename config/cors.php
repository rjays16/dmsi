<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => [
        'api/*',
        'api/admin/*',
        'api/admin/members/*',
        'api/admin/members/pending/*',
        'api/users/*',
        'api/pcr/*',
        'api/pcr/upload/deposit/*',
        '*'
    ],

    'allowed_methods' => ['POST', 'GET', 'DELETE', 'PUT', '*'],

    'allowed_origins' => [
        'http://dms-api.local',
        'http://dms-frontend.local',
        'http://127.0.0.1:8000',
        'http://127.0.0.1:8080',
        'https://mdms-api.porth365.com',
        'https://mdms.porth365.com',
        'https://beta-mdms-api.porth365.com',
        'https://beta-mdms.porth365.com'
    ],

    'allowed_origins_patterns' => ['Google\\' ,'*'],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
