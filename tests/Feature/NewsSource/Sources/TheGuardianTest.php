<?php

namespace Tests\Feature\NewsSource\Sources;

use App\NewsSource\Sources\TheGuardian;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\DataProviders\Api\TheGuardianDataProvider;
use Tests\TestCase;

class TheGuardianTest extends TestCase
{
    #[Test]
    public function it_makes_the_api_request(): void
    {
        Http::fake([
            'content.guardianapis.com/*' => []
        ]);

        // When you call the API
        $theGuardian = new TheGuardian;

        $theGuardian->getArticles();

        // Assert that it makes the request to the right url and with right api key header
        Http::assertSent(function (Request $request) {
            return $request->hasHeader('api-key') &&
                   strtok($request->url(), '?') == 'https://content.guardianapis.com/search' &&
                   $request->method() == 'GET' &&
                   $request['lang'] == 'en';
        });
    }

    #[Test]
    public function it_returns_the_formatted_articles_list(): void
    {
        $apiData = TheGuardianDataProvider::getApiData();

        Http::fake([
            'content.guardianapis.com/*' => Http::response($apiData, 200)
        ]);

        // When you call the API
        $newsApi = new TheGuardian;

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

        $this->assertSame($articles[5]['title'], $apiData['response']['results'][5]['webTitle']);
        $this->assertSame($articles[1]['image'], NULL);
        $this->assertSame($articles[1]['summary'], NULL);
        $this->assertSame($articles[0]['source'], 'The Guardian');
        $this->assertSame($articles[0]['news_source'], 'TheGuardian');
        $this->assertInstanceOf(Carbon::class, $articles[0]['published_at']);
    }
}
