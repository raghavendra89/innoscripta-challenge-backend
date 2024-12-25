<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $article = parent::toArray($request);

        // Use a placeholder image as it doesn't look good,
        // if the article doesn't have an image
        $article['summary'] = $article['summary'] ?? $article['title'];
        $article['image'] = $article['image'] ?? 'https://picsum.photos/id/'. rand(1, 50) .'/300/200';

        return $article;
    }
}
