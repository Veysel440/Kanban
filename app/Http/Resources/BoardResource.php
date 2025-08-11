<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoardResource extends JsonResource {
    public function toArray($request){
        return [
            'id'=>(string)$this->_id,
            'name'=>$this->name,
            'members'=>$this->members ?? [],
            'created_at'=>$this->created_at,
        ];
    }
}
