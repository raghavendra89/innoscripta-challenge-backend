<?php

namespace App\NewsSource\Sources;

use Illuminate\Support\Carbon;
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

        return $this->formatArticles($response->json()['response']['docs']);
    }

    private function formatArticles($articles)
    {
        $formattedArticles = [];

        foreach ($articles as $article) {
            $formattedArticles[] = [
                'title' => $article['headline']['main'],
                'summary' => $article['snippet'],
                'content' => $article['lead_paragraph'],
                'url' => $article['web_url'],
                'image' => $article['multimedia'] ? $article['multimedia'][0]['url'] : NULL,
                'author' => $article['byline'] ? $article['byline']['original'] : NULL,
                'source' => 'The New York Times',
                'news_source' => 'NyTimes',
                'categories' => $article['subsection_name'] ?? $article['section_name'],
                'published_at' => Carbon::parse($article['pub_date'])
            ];
        }

        return $formattedArticles;
    }
}