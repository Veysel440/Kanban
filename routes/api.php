<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Boards\BoardController;
use App\Http\Controllers\Api\Cards\CardMoveController;
use App\Http\Controllers\Api\Activities\ActivityController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/boards/{board}/cards', [BoardController::class,'storeCard']);
    Route::patch('/cards/{card}/move', [CardMoveController::class,'__invoke']);
    Route::get('/boards/{board}/activities', [ActivityController::class,'index']);
});
