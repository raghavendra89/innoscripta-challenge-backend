<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private function isSqlite(): bool
    {
        return 'sqlite' === Schema::connection($this->getConnection())
                ->getConnection()
                ->getPdo()
                ->getAttribute(PDO::ATTR_DRIVER_NAME);
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 500);
            $table->text('summary')->nullable();
            $table->text('content')->nullable();
            // Generally An URL can be upto 2083 characters.
            // But I'm setting the limit here because MySQL
            // unique has a limitation of 3072 bytes.
            $table->string('url', 500)->nullable();
            $table->string('image', 2000)->nullable();
            $table->string('author')->nullable();
            $table->string('source')->nullable();
            $table->string('news_source', 20)->nullable();
            $table->string('categories')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index('source');
            $table->index('categories');

            $table->unique(['url', 'news_source']);

            // Testing: fulltext index is not supported in sqlite
            if (! $this->isSqlite()) {
                $table->fullText('title');
                $table->fullText('summary');
                $table->fullText('content');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
