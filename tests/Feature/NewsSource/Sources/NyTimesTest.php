<?php

namespace Tests\Feature\NewsSource\Sources;

use App\NewsSource\Sources\NyTimes;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\DataProviders\Api\NyTimesDataProvider;
use Tests\TestCase;

class NyTimesTest extends TestCase
{
    #[Test]
    public function it_makes_the_api_request(): void
    {
        Http::fake([
            'api.nytimes.com/*' => []
        ]);

        // When you call the API
        $nyTimes = new NyTimes;

        $nyTimes->getArticles();

        // Assert that it makes the request to the right url and with right api key header
        Http::assertSent(function (Request $request) {
            return strtok($request->url(), '?') == 'https://api.nytimes.com/svc/search/v2/articlesearch.json' &&
                   $request->method() == 'GET' &&
                   ! empty($request['api-key']);
        });
    }

    #[Test]
    public function it_returns_the_formatted_articles_list(): void
    {
        $apiData = NyTimesDataProvider::getApiData();

        Http::fake([
            'api.nytimes.com/*' => Http::response($apiData, 200)
        ]);

        // When you call the API
        $newsApi = new NyTimes;

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

        $this->assertSame($articles[5]['title'], $apiData['response']['docs'][5]['headline']['main']);
        $this->assertSame($articles[2]['url'], $apiData['response']['docs'][2]['web_url']);
        $this->assertSame($articles[1]['image'], $apiData['response']['docs'][1]['multimedia'][0]['url']);
        $this->assertSame($articles[1]['summary'], $apiData['response']['docs'][1]['snippet']);
        $this->assertSame($articles[0]['source'], 'The New York Times');
        $this->assertSame($articles[0]['news_source'], 'NyTimes');
        $this->assertInstanceOf(Carbon::class, $articles[3]['published_at']);
    }
}
