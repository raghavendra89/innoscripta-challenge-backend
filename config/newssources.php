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
    | Configuration details required to make the API request to The Guardian.
    |
    */

    'theguardian' => [
        'api_key' => env('THE_GUARDIAN_API_KEY', ''),
        'api_endpoint' => 'https://content.guardianapis.com/search'
    ],

    /*
    |--------------------------------------------------------------------------
    | NewYorck Times API details
    |--------------------------------------------------------------------------
    |
    | Configuration details required to make the API request to the NewYork Times.
    |
    */

    'nytimes' => [
        'api_key' => env('NY_TIMES_API_KEY', ''),
        'api_endpoint' => 'https://api.nytimes.com/svc/search/v2/articlesearch.json'
    ],

    /*
    |--------------------------------------------------------------------------
    | NewsData.io API details
    |--------------------------------------------------------------------------
    |
    | Configuration details required to make the API request to the NewsData.io.
    |
    */

    'newsdata' => [
        'api_key' => env('NEWSDATA_API_KEY', ''),
        'api_endpoint' => 'https://newsdata.io/api/1/latest'
    ]
];