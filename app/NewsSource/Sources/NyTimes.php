<?php

namespace App\NewsSource\Sources;

use Illuminate\Support\Facades\Http;

class NyTimes implements NewsSourceInterface
{
    protected $apiKey;
    protected $apiEndPoint;

    public function __construct()
    {
        $this->apiKey = config('newssources.nytimes.api_key');
        $this->apiEndPoint = config('newssources.nytimes.api_endpoint');
    }

    public function getArticles(): array
    {
        $response = Http::get($this->apiEndPoint, [
            'api-key' => $this->apiKey
        ]);

        return $response->json();
    }
}