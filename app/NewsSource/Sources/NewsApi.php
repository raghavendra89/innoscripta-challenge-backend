<?php

namespace App\NewsSource\Sources;

use Illuminate\Support\Carbon;
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

        return $this->formatArticles($response->json()['articles']);
    }

    private function formatArticles($articles)
    {
        $formattedArticles = [];

        foreach ($articles as $article) {
            if (strpos($article['url'], 'removed.com') !== FALSE) {
                continue;
            }

            $formattedArticles[] = [
                'title' => $article['title'],
                'summary' => $article['description'],
                'content' => $article['content'],
                'url' => $article['url'],
                'image' => $article['urlToImage'],
                'author' => $article['author'],
                'source' => $article['source']['name'],
                'news_source' => 'NewsApi',
                'categories' => '',
                'published_at' => Carbon::parse($article['publishedAt'])
            ];
        }

        return $formattedArticles;
    }
}