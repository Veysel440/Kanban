<?php

namespace App\Events;

use App\Models\Mongo\Card;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CardMoved implements ShouldBroadcast {
    public function __construct(public Card $card, public string $boardId, public array $activity) {}
    public function broadcastOn(){ return new PrivateChannel("boards.{$this->boardId}"); }
    public function broadcastAs(){ return 'CardMoved'; }
    public function broadcastWith(){
        return [
            'card'=>$this->card->only(['_id','list_id','order','title']),
            'activity'=>$this->activity
        ];
    }
}
