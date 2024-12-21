<?php

namespace Tests\Unit\NewsSources;

use App\NewsSources\NyTimes;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
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
        // Assert that it is not sending any query params
        Http::assertSent(function (Request $request) {
            return strtok($request->url(), '?') == 'https://api.nytimes.com/svc/search/v2/articlesearch.json' &&
                   $request->method() == 'GET' &&
                   ! empty($request['api-key']);
        });
    }
}
