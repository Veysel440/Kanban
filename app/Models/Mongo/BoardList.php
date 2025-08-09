<?php

namespace App\Models\Mongo;

class BoardList extends BaseMongoModel {
    protected $collection = 'lists';
    protected $fillable = ['board_id','title','order'];
    protected static function booted(){
        static::raw(fn($c)=>$c->createIndex(['board_id'=>1,'order'=>1]));
    }
}
