<?php

namespace Tests\Feature\NewsSource;

use App\NewsSource\NewsSource;
use App\NewsSource\Sources\NewsSourceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class NewsSourceTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    #[DataProviderExternal(\Tests\DataProviders\FormattedArticlesDataProvider::class, 'getArticles')]
    public function it_pulls_the_articles_from_a_gven_source($sourceData): void
    {
        foreach ($sourceData as &$article) {
            $article['published_at'] = Carbon::parse($article['published_at']);
        }

        $sourceMock = $this->createMock(NewsSourceInterface::class);
        $sourceMock->expects($this->once())
                   ->method('getArticles')
                   ->willReturn($sourceData);

        // When you pull the articles
        $newsSource = new NewsSource($sourceMock);

        $insertedCount = $newsSource->pullArticles();

        $this->assertSame($insertedCount, count($sourceData));

        // Assert DB entries
        $this->assertDatabaseCount('articles', count($sourceData));
    }
}
