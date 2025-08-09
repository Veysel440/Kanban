<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Mongo\Board;

Broadcast::channel('boards.{boardId}', function ($user, $boardId) {
    $board = Board::find($boardId);
    return $board && in_array($user->id, $board->members ?? []);
});
