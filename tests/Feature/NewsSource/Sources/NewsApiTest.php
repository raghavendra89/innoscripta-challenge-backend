<?php

namespace Tests\Feature\NewsSource\Sources;

use App\NewsSource\Sources\NewsApi;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
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
}
