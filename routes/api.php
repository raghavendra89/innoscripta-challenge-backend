<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

// News route
Route::get('/news', [NewsController::class, 'getArticles']);
Route::get('/articles/{articleId}', [NewsController::class, 'getNewsArticle']);

// Get all the preference options
Route::get('/preferences', [NewsController::class, 'getPreferences']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/preferences', [UserController::class, 'getPreferences']);
    Route::post('/user/preferences', [UserController::class, 'updatePreferences']);

    Route::get('/news/personalized', [NewsController::class, 'getPersonalizedArticles']);

    Route::get('/admin/data', [AdminController::class, 'getData']);
    Route::post('/admin/pull-news', [AdminController::class, 'pullNews']);
});

Route::get('/user', function (Request $request) {
    return new UserResource($request->user());
})->middleware('auth:sanctum');
