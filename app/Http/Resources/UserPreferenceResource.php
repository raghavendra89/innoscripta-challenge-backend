<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserPreferenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'sources' => explode(',', $this->sources),
            'categories' => explode(',', $this->categories),
            'authors' => explode(',', $this->authors)
        ];
    }
}
