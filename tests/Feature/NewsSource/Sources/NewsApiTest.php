<?php

namespace Tests\Feature\NewsSource\Sources;

use App\NewsSource\Sources\NewsApi;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\DataProviders\Api\NewsApiDataProvider;
use Tests\TestCase;

class NewsApiTest extends TestCase
{
    #[Test]
    public function it_makes_the_api_request(): void
    {
        Http::fake([
            'newsapi.org/*' => []
        ]);

        // When you call the API
        $newsApi = new NewsApi;

        $newsApi->getArticles();

        // Assert that it makes the request to the right url and with right api key header
        Http::assertSent(function (Request $request) {
            return $request->hasHeader('X-Api-Key') &&
                   strtok($request->url(), '?') == 'https://newsapi.org/v2/top-headlines' &&
                   $request->method() == 'GET' &&
                   $request['language'] == 'en';
        });
    }

    #[Test]
    public function it_returns_the_formatted_articles_list(): void
    {
        $apiData = NewsApiDataProvider::getApiData();

        Http::fake([
            'newsapi.org/*' => Http::response($apiData, 200)
        ]);

        // When you call the API
        $newsApi = new NewsApi;

        $articles = $newsApi->getArticles();

        // There are 2 entries with removed.com.
        // So only 18 entries are counted.
        $this->assertCount(18, $articles);

        $this->assertArrayHasKey('title', $articles[0]);
        $this->assertArrayHasKey('summary', $articles[0]);
        $this->assertArrayHasKey('content', $articles[0]);
        $this->assertArrayHasKey('url', $articles[0]);
        $this->assertArrayHasKey('image', $articles[0]);
        $this->assertArrayHasKey('author', $articles[0]);
        $this->assertArrayHasKey('source', $articles[0]);
        $this->assertArrayHasKey('categories', $articles[0]);
        $this->assertArrayHasKey('published_at', $articles[0]);

        // Be careful here as the entrie with 'remove.com' has been removed.
        // So the indexes may not match.
        $this->assertSame($articles[1]['image'], $apiData['articles'][1]['urlToImage']);
        $this->assertSame($articles[1]['summary'], $apiData['articles'][1]['description']);
        $this->assertSame($articles[0]['source'], $apiData['articles'][0]['source']['name']);
        $this->assertSame($articles[0]['news_source'], 'NewsApi');
        $this->assertInstanceOf(Carbon::class, $articles[0]['published_at']);
    }
}
