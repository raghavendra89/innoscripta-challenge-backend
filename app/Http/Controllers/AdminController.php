<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct(Request $request)
    {
        if (! $request->user()->is_admin) {
            abort(401);
        }
    }

    public function getData(): JsonResponse
    {
        $newsSourcesList = Article::groupBy('news_source')
                                ->select('news_source', DB::raw('count(*) as total'))
                                ->get()->toArray();

        $newsSources = [];
        foreach ($newsSourcesList as $newsSource) {
            $newsSources[$newsSource['news_source']] = $newsSource['total'];
        }

        $totalUsers = User::count();

        return response()->json([
            'news_sources' => $newsSources,
            'total_users' => $totalUsers
        ]);
    }

    public function pullNews(Request $request): JsonResponse
    {
        $prevCount = Article::where('news_source', $request->source)->count();

        try {
            Artisan::call("news:pull", ['--source' => $request->source]);
        } catch(\Exception $e) {
        }

        $newCount = Article::where('news_source', $request->source)->count();

        return response()->json(['count' => $newCount - $prevCount]);
    }
}
