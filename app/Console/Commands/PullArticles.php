<?php

namespace App\Console\Commands;

use App\NewsSource\NewsSource;
use App\NewsSource\Sources\NewsApi;
use App\NewsSource\Sources\NewsData;
use App\NewsSource\Sources\NyTimes;
use App\NewsSource\Sources\TheGuardian;
use Illuminate\Console\Command;

class PullArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:pull {--S|source= : Valid options: NewsApi, NewsData, TheGuardian, NyTimes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull News Articles from a given source.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $source = strtolower($this->option('source'));

        if (! in_array($source, ['newsapi', 'newsdata', 'theguardian', 'nytimes'])) {
            $this->fail('News source is not valid. Valid options: NewsApi, NewsData, TheGuardian, NyTimes.');
        }

        $this->info('Pulling the articles...');

        $source = [
            'newsapi' => new NewsApi,
            'newsdata' => new NewsData,
            'theguardian' => new TheGuardian,
            'nytimes' => new NyTimes,
        ][$source];

        $articlesCount = (new NewsSource($source))->pullArticles();


        $this->info('Completed. Pulled ' . $articlesCount . ' articles from the ' . $this->option('source') . '.');
    }
}
