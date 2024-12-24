<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class NewsFullTextQueryTest extends TestCase
{
    use DatabaseMigrations;

    // Sqlite doesn't support full text search
    #[Test]
    public function it_searches_the_articles(): void
    {
        $text = 'Rate cuts, stock surges, and Trump’s tariff threats are among the biggest forces shaping business and the economy';
        // Create 3 articles with keywords: 
        $article1 = Article::factory()->create(['title' => $text]);

        $article2 = Article::factory()->create(['summary' => $text]);

        $article3 = Article::factory()->create(['content' => $text]);

        // Create other dummy articles without keywords.
        // Assumes that the faker will not generate the content with keywords.
        Article::factory(5)->create();

        $response = $this->getJson('/api/news?search=economy,tariff');

        $response->assertOk();

        $response->assertJsonCount(3, 'data');
    }

    #[Test]
    public function it_filters_the_articles(): void
    {
        // Create 3 articles with keywords: 
        Article::factory()->create(['source' => 'Sky News', 'published_at' => now()->subDays(5)]);

        Article::factory()->create(['source' => 'Sky News', 'published_at' => now()->subDays(20)]);

        Article::factory()->create(['source' => 'Sky News', 'published_at' => now()->subDays(7)]);

        Article::factory()->create(['source' => 'The Guardian']);

        Article::factory(3)->create(['source' => 'BBC']);

        $fromDate = now()->subDays(10)->toDateString();
        $toDate = now()->toDateString();
        $response = $this->getJson('/api/news?sources[]=Sky News&from_date=' . $fromDate . '&to_date=' . $toDate);

        $response->assertOk();

        $response->assertJsonCount(2, 'data');
    }
}
