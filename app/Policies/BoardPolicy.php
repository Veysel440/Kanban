<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Mongo\Board;

class BoardPolicy {
    public function member(User $user, Board $board): bool {
        return in_array($user->id, $board->members ?? []);
    }
}
