<?php

namespace App\Domain\Cards;

use App\Models\Mongo\Card;

interface CardServiceInterface {
    public function move(string $cardId, string $toListId, ?float $before, ?float $after, int $actorId): Card;
}
