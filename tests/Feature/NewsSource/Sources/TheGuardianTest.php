<?php

namespace Tests\Feature\NewsSource\Sources;

use App\NewsSource\Sources\TheGuardian;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
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
}
