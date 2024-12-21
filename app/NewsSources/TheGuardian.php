<?php

namespace App\NewsSources;

use Illuminate\Support\Facades\Http;

class TheGuardian implements NewsSourceInterface
{
    protected $apiKey;
    protected $apiEndPoint;

    public function __construct()
    {
        $this->apiKey = config('newssources.theguardian.api_key');
        $this->apiEndPoint = config('newssources.theguardian.api_endpoint');
    }

    public function getArticles(): array
    {
        $response = Http::withHeaders([
            'api-key' => $this->apiKey
        ])->get($this->apiEndPoint, ['lang' => 'en']);

        return $response->json();
    }
}