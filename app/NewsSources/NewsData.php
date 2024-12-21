<?php

namespace App\NewsSources;

use Illuminate\Support\Facades\Http;

class NewsData implements NewsSourceInterface
{
    protected $apiKey;
    protected $apiEndPoint;

    public function __construct()
    {
        $this->apiKey = config('newssources.newsdata.api_key');
        $this->apiEndPoint = config('newssources.newsdata.api_endpoint');
    }

    public function getArticles(): array
    {
        $response = Http::get($this->apiEndPoint, [
            'apikey' => $this->apiKey,
            'language' => 'en'
        ]);

        return $response->json();
    }
}