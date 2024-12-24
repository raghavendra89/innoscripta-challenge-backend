<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserPreferenceResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updatePreferences(Request $request): UserPreferenceResource | JsonResponse
    {
        $request->validate([
            'sources' => 'required_without_all:categories,authors|array',
            'categories' => 'required_without_all:sources,authors|array',
            'authors' => 'required_without_all:categories,sources|array'
        ]);

        // Filter by preferences
        $preferences = $request->user()
                            ->preferences()
                            ->firstOrCreate(
                                ['user_id' => $request->user()->id],
                                [
                                    'sources' => implode(',', $request->sources ?? []),
                                    'categories' => implode(',', $request->categories ?? []),
                                    'authors' => implode(',', $request->authors ?? [])
                                ]
                            );

        return (new UserPreferenceResource($preferences));
    }
}
