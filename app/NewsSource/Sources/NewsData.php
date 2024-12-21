<?php

namespace App\NewsSource\Sources;

use Illuminate\Support\Carbon;
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

        return $this->formatArticles($response->json()['results']);
    }

    private function formatArticles($articles)
    {
        $formattedArticles = [];

        foreach ($articles as $article) {
            $formatArticles[] = [
                'title' => $article['title'],
                'summary' => $article['description'],
                // Content is not available for free plans in this API
                'content' => '',
                'url' => $article['link'],
                'image' => $article['image_url'],
                'author' => $article['creator'] ? $article['creator'][0] : NULL,
                'source' => $article['source_name'],
                'news_source' => 'Newsdata',
                'categories' => $article['category'] ? implode(',', $article['category']) : NULL,
                'published_at' => Carbon::parse($article['pubDate'])
            ];
        }

        return $formatArticles;
    }
}