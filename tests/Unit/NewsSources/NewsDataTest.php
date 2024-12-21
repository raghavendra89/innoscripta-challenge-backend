<?php

namespace Tests\Unit\NewsSources;

use App\NewsSources\NewsData;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class NewsDataTest extends TestCase
{
    #[Test]
    public function it_makes_the_api_request(): void
    {
        Http::fake([
            'newsdata.io/*' => []
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
}
