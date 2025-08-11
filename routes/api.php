<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Boards\BoardController;
use App\Http\Controllers\Api\Activities\ActivityController;
use App\Http\Controllers\Api\Lists\BoardListController;
use App\Http\Controllers\Api\Cards\{CardController,CardMoveController};

Route::middleware('auth:sanctum')->group(function () {
    // Boards
    Route::get('/boards', [BoardController::class,'index']);
    Route::post('/boards', [BoardController::class,'store']);
    Route::get('/boards/{board}', [BoardController::class,'show']);
    Route::post('/boards/{board}/cards', [BoardController::class,'storeCard']);

    // Lists
    Route::get('/boards/{board}/lists', [BoardListController::class,'index']);
    Route::post('/lists', [BoardListController::class,'store']);
    Route::put('/lists/{list}', [BoardListController::class,'update']);
    Route::delete('/lists/{list}', [BoardListController::class,'destroy']);

    // Cards
    Route::post('/cards', [CardController::class,'store']);
    Route::put('/cards/{card}', [CardController::class,'update']);
    Route::delete('/cards/{card}', [CardController::class,'destroy']);
    Route::patch('/cards/{card}/move', [CardMoveController::class,'__invoke']);

    // Activities
    Route::get('/boards/{board}/activities', [ActivityController::class,'index']);
    Route::post('/boards/{board}/cards', [BoardController::class,'storeCard']);
});
