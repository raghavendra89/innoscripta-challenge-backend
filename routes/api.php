<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

// News route
Route::get('/news', [NewsController::class, 'getArticles']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/user/preferences', [UserController::class, 'updatePreferences']);

    Route::get('/news/personalized', [NewsController::class, 'getPersonalizedArticles']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
