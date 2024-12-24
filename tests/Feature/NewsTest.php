<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_retrieves_latest_news_articles(): void
    {
        // Generate 40 articles
        $articles = Article::factory(40)->create()->toArray();

        $response = $this->getJson('/api/news');

        $response->assertOk();

        $response->assertJsonCount(30, 'data');

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'title',
                    'summary',
                    'content',
                    'url',
                    'image',
                    'author',
                    'source',
                    'news_source',
                    'categories',
                    'published_at'
                ]
            ]
        ]);

        $response->assertJsonFragment(['title' => $articles[0]['title']]);
    }

    #[Test]
    public function it_returns_empty_collection_if_table_is_empty(): void
    {
        $response = $this->getJson('/api/news');

        $response->assertOk();

        $response->assertJsonCount(0, 'data');
    }
}
