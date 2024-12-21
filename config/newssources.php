<?php

return [
    /*
    |--------------------------------------------------------------------------
    | NewsAPI details
    |--------------------------------------------------------------------------
    |
    | Configuration details required to make the API request to NewsAPI.
    |
    */

    'newsapi' => [
        'api_key' => env('NEWSAPI_ORG_API_KEY', ''),
        'api_endpoint' => 'https://newsapi.org/v2/top-headlines'
    ],

    /*
    |--------------------------------------------------------------------------
    | TheGuardian API details
    |--------------------------------------------------------------------------
    |
    | Configuration details required to make the API request to NewsAPI.
    |
    */

    'theguardian' => [
        'api_key' => env('THE_GUARDIAN_API_KEY', ''),
        'api_endpoint' => 'https://content.guardianapis.com/search'
    ]
];