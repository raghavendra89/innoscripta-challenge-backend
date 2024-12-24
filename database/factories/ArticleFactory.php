<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sources = [
            'The Guardian',
            'New York Times',
            'Los Angeles Times',
            'Wall Street Journal',
            'BBC',
            'ESPN Sports',
            'Sky News'
        ];

        $newsSources = ['NewsApi', 'NewsData', 'TheGuardian', 'NyTimes'];

        $categories = [
            'Technology',
            'Politics',
            'Sports',
            'Entertainment',
            'Music',
            'Economy',
            'Busincess',
            'LifeStyle'
        ];

        return [
            'title' => fake()->text(150),
            'summary' => fake()->text(300),
            'content' => fake()->text(500),
            'url' => fake()->url(),
            'image' => fake()->url(),
            'author' => fake()->name(),
            'source' => Arr::random($sources),
            'news_source' => Arr::random($newsSources),
            // Get random 2 categories. Perhaps we can make sure they are unique.
            'categories' => implode(',', [Arr::random($categories), Arr::random($categories)]),
            'published_at' => now()->subDays(rand(1, 100))
        ];
    }
}
