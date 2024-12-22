<?php

namespace Tests\Feature\NewsSource\Sources;

use App\NewsSource\Sources\NewsData;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\DataProviders\Api\NewsDataDataProvider;
use Tests\TestCase;

class NewsDataTest extends TestCase
{
    #[Test]
    public function it_makes_the_api_request(): void
    {
        Http::fake([
            'newsdata.io/*' => ['results' => []]
        ]);

        // When you call the API
        $newsData = new NewsData;

        $newsData->getArticles();

        // Assert that it makes the request to the right url and with right api key header
        Http::assertSent(function (Request $request) {
            return strtok($request->url(), '?') == 'https://newsdata.io/api/1/latest' &&
                   $request->method() == 'GET' &&
                   $request['language'] == 'en' &&
                   ! empty($request['apikey']);
        });
    }

    #[Test]
    public function it_returns_the_formatted_articles_list(): void
    {
        $apiData = NewsDataDataProvider::getApiData();

        Http::fake([
            'newsdata.io/*' => Http::response($apiData, 200)
        ]);

        // When you call the API
        $newsApi = new NewsData;

        $articles = $newsApi->getArticles();

        $this->assertCount(10, $articles);

        $this->assertArrayHasKey('title', $articles[0]);
        $this->assertArrayHasKey('summary', $articles[0]);
        $this->assertArrayHasKey('content', $articles[0]);
        $this->assertArrayHasKey('url', $articles[0]);
        $this->assertArrayHasKey('image', $articles[0]);
        $this->assertArrayHasKey('author', $articles[0]);
        $this->assertArrayHasKey('source', $articles[0]);
        $this->assertArrayHasKey('categories', $articles[0]);
        $this->assertArrayHasKey('published_at', $articles[0]);

        $this->assertSame($articles[5]['title'], $apiData['results'][5]['title']);
        $this->assertSame($articles[1]['image'], $apiData['results'][1]['image_url']);
        $this->assertSame($articles[1]['summary'], $apiData['results'][1]['description']);
        $this->assertSame($articles[0]['source'], $apiData['results'][0]['source_name']);
        $this->assertSame($articles[0]['news_source'], 'Newsdata');
        $this->assertInstanceOf(Carbon::class, $articles[0]['published_at']);
    }
}
