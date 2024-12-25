<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class UserPreferenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $sources = Arr::where(explode(',', $this->sources), function ($source) {
            return ! empty($source);
        });

        $categories = Arr::where(explode(',', $this->categories), function ($category) {
            return ! empty($category);
        });

        $authors = Arr::where(explode(',', $this->authors), function ($author) {
            return ! empty($author);
        });

        return [
            'sources' => $sources,
            'categories' => $categories,
            'authors' => $authors
        ];
    }
}
