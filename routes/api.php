<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataFetchController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

#user routes
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::delete('/delete-account', [AuthController::class, 'deleteAccount']);
});

Route::get("/games", [GameController::class, 'index']);
Route::get("/games/{game}", [GameController::class, 'show']);
Route::post('/games/attach', [GameController::class, 'attachAll']);
#reviews routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/reviews', [ReviewController::class, 'index']);
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::get('/reviews/{review}', [ReviewController::class, 'show']);
    Route::put('/reviews/{review}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);
    Route::get('/user/reviews', [ReviewController::class, 'getUserReviews']);
    Route::get('/game/reviews/{id}', [ReviewController::class, 'getGameReviews']);
});

#playlists routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/playlists', [PlaylistController::class, 'store'])->name("playlists.store");
    Route::get('/playlists', [PlaylistController::class, 'index'])->name("playlists");
    Route::get('/playlists/{playlist}', [PlaylistController::class, 'show'])->name("playlists.show");
    Route::put('/playlists/{playlist}', [PlaylistController::class, 'update'])->name("playlists.update");
    Route::delete('playlists/{playlist}', [PlaylistController::class, 'destroy'])->name("playlists.destroy");
    Route::post('/playlists/{playlist}/games/add', [PlaylistController::class, 'addGame'])->name("playlists.addGame");
    Route::post('/playlists/{playlist}/games/remove', [PlaylistController::class, 'removeGame'])->name("playlist.removeGame");
});


