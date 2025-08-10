<?php

namespace App\Infra\Mongo;

use App\Domain\Cards\CardRepositoryInterface;
use App\Models\Mongo\Card;
use Illuminate\Support\Facades\Log;

class CardRepository implements CardRepositoryInterface {
    public function find(string $id): ?Card { return Card::find($id); }

    public function updateOrder(Card $card, string $listId, float $order): Card {
        try{
            $card->list_id = $listId;
            $card->order = $order;
            $card->save();
            return $card;
        }catch(\Throwable $e){
            Log::error('Card updateOrder failed', ['card'=>$card->_id,'e'=>$e->getMessage()]);
            throw $e;
        }
    }
}
