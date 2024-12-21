<?php

namespace App\NewsSource\Sources;

use Illuminate\Support\Carbon;
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

        return $this->formatArticles($response->json()['response']['results']);
    }

    private function formatArticles($articles)
    {
        $formattedArticles = [];

        foreach ($articles as $article) {
            $formatArticles[] = [
                'title' => $article['webTitle'],
                'summary' => NULL,
                // Content is not available in this API
                'content' => '',
                'url' => $article['webUrl'],
                'image' => NULL,
                'author' => NULL,
                'source' => 'The Guardian',
                'news_source' => 'TheGuardian',
                // Is this the right category?
                'categories' => $article['pillarName'],
                'published_at' => Carbon::parse($article['webPublicationDate'])
            ];
        }

        return $formatArticles;
    }
}