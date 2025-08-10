<?php

namespace App\Domain\Cards;

use App\Models\Mongo\Card;

interface CardRepositoryInterface {
    public function find(string $id): ?Card;
    public function updateOrder(Card $card, string $listId, float $order): Card;
}
