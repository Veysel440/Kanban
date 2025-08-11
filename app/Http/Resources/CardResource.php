<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource {
    public function toArray($request){
        return [
            'id'=>(string)$this->_id,
            'list_id'=>(string)$this->list_id,
            'title'=>$this->title,
            'desc'=>$this->desc,
            'tags'=>$this->tags ?? [],
            'assignees'=>$this->assignees ?? [],
            'due_at'=>$this->due_at,
            'order'=>$this->order,
        ];
    }
}
