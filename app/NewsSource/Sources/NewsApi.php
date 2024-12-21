<?php

namespace App\NewsSource\Sources;

use Illuminate\Support\Facades\Http;

class NewsApi implements NewsSourceInterface
{
    protected $apiKey;
    protected $apiEndPoint;

    public function __construct()
    {
        $this->apiKey = config('newssources.newsapi.api_key');
        $this->apiEndPoint = config('newssources.newsapi.api_endpoint');
    }

    public function getArticles(): array
    {
        $response = Http::withHeaders([
            'X-Api-Key' => $this->apiKey
        ])->get($this->apiEndPoint, ['language' => 'en']);

        return $response->json();
    }
}