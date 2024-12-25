<?php

namespace App\Http\Controllers;

use App\Exceptions\UserPreferencesNotSetException;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private function buildSearchQuery($articleQuery, Request $request)
    {
        // Do a full text search on the key columns
        // if ($request->search) {
        //     $searchStrings = is_array($request->search)
        //                 ? $request->search
        //                 : explode(',', $request->search);

        //     foreach ($searchStrings as $key => $searchString) {
        //         if ($key == 0) {
        //             $articleQuery->whereFullText(['title', 'summary', 'content'], $searchString);
        //         } else {
        //             $articleQuery->orWhereFullText(['title', 'summary', 'content'], $searchString);
        //         }
        //     }
        // }

        if ($request->search) {
            $searchStrings = is_array($request->search)
                            ? $request->search
                            : explode(',', $request->search);

            $articleQuery->where(function (Builder $query) use($searchStrings) {
                foreach ($searchStrings as $key => $searchString) {
                    if ($key == 0) {
                        $query->whereFullText(['title', 'summary', 'content'], $searchString);
                    } else {
                        $query->orWhereFullText(['title', 'summary', 'content'], $searchString);
                    }
                }
            });
        }

        return $articleQuery;
    }

    public function getArticles(Request $request): JsonResponse
    {
        $articleQuery = Article::query();

        $articleQuery = $this->buildSearchQuery($articleQuery, $request);

        if ($request->sources && ! empty($request->sources)) {
            $articleQuery->whereIn('source', $request->sources);
        }

        if ($request->categories && ! empty($request->categories)) {
            $articleQuery->whereIn('categories', $request->categories);
        }

        if ($request->from_date) {
            $articleQuery->whereDate('published_at', '>=', $request->from_date);
        }

        if ($request->to_date) {
            $articleQuery->whereDate('published_at', '<=', $request->to_date);
        }

        return response()->json([
            'data' => ArticleResource::collection($articleQuery->take(30)->get())
        ]);
    }

    public function getPersonalizedArticles(Request $request): JsonResponse
    {
        if ($request->user()->hasNotSetPreferences()) {
            throw new UserPreferencesNotSetException();
        }

        $articleQuery = Article::query();

        $preferences = $request->user()->preferences;

        if (! empty($preferences->sources)) {
            $articleQuery->orWhereIn('source', explode(',', $preferences->sources));
        }

        if (! empty($preferences->categories)) {
            $articleQuery->orWhereIn('categories', explode(',', $preferences->categories));
        }

        if (! empty($preferences->authors)) {
            $articleQuery->orWhereIn('author', explode(',', $preferences->authors));
        }

        $articleQuery = $this->buildSearchQuery($articleQuery, $request);

        // Should also return the current preferences?
        return response()->json([
            'data' => ArticleResource::collection($articleQuery->take(30)->get())
        ]);
    }

    public function getPreferences(): JsonResponse
    {
        return response()->json([
            'sources' => Article::getDistinctValues('source'),
            'categories' => Article::getDistinctValues('categories'),
            'authors' => Article::getDistinctValues('author')
        ]);
    }

    public function getNewsArticle($articleId): ArticleResource | JsonResponse
    {
        $article = Article::findOrFail($articleId);

        return (new ArticleResource($article));
    }
}
