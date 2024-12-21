<?php

namespace Tests\Feature\Console\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PullArticlesTest extends TestCase
{
    #[Test]
    public function it_shows_error_message_in_console_for_invalid_source(): void
    {
        $this->artisan('news:pull --source=Test')
             ->expectsOutputToContain('News source is not valid.')
             ->assertFailed();
    }
}
