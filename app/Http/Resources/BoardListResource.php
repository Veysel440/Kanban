<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoardListResource extends JsonResource {
    public function toArray($request){
        return [
            'id'=>(string)$this->_id,
            'board_id'=>(string)$this->board_id,
            'title'=>$this->title,
            'order'=>$this->order,
        ];
    }
}
