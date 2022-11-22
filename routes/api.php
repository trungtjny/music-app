<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::resource('/musics', MusicController::class)->except(['store', 'destroy']);
Route::resource('/albums', AlbumController::class)->except(['store', 'destroy']);
Route::middleware('auth:api')->group(function () {
    Route::resource('/playlists', PlaylistController::class);
});
Route::get('/top-5-songs', [MusicController::class, 'bestMusic']);
Route::get('/search', [MusicController::class, 'search']);
Route::get('/category', [CategoryController::class, 'list']);
Route::get('/category-music', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::get('/search', [MusicController::class, 'search']);
Route::get('/recommend/{id}', [MusicController::class, 'musicRecommended']);
Route::get('/list-singer', [MusicController::class, 'listSinger']);
Route::get('/detail/singer/{id}', [MusicController::class, 'detailSinger']);
Route::middleware('auth:api')->group(function () {
    Route::post('/payment', [StripePaymentController::class, 'stripePost']);
    Route::put('/user/{id}', [AuthController::class, 'update']);
    Route::get('/my-music', [MusicController::class, 'myMusic']);
    Route::get('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/info', [AuthController::class, 'getme']);
    Route::resource('/playlists', PlaylistController::class);
    Route::post('/change-playlist', [ PlaylistController::class, 'change']);
    Route::post('/report', [ ReportController::class, 'store']);
    Route::get('list-verify', [AuthController::class, 'ListVerify']);
    //Route::resource('/albums', AlbumController::class)->except(['store', 'destroy']);
    Route::middleware('permission:singer')->group(function() {
        Route::resource('/musics', MusicController::class)->only(['store','destroy']);
        Route::post('/albums', [AlbumController::class, 'store']);
        Route::delete('/albums/{id}', [AlbumController::class, 'destroy']);
    });
});
