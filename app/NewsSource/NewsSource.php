<?php

namespace App\NewsSource;

use App\Models\Article;
use App\NewsSource\Sources\NewsSourceInterface;

class NewsSource
{
    protected $source;

    public function __construct(NewsSourceInterface $source)
    {
        $this->source = $source;
    }

    public function pullArticles(): int
    {
        $articles = $this->source->getArticles();

        foreach ($articles as &$article) {
            // Generally An URL can be upto 2083 characters.
            // But I'm setting the limit here because MySQL
            // unique has a limitation of 3072 bytes.
            $article['url'] = substr($article['url'], 0, 500);
        }

        // Unique by url and news_source
        $count = Article::upsert(
            $articles,
            uniqueBy: ['url', 'news_source']
        );

        return $count;
    }
}