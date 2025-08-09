<?php

namespace App\Models\Mongo;

class Activity extends BaseMongoModel {
    protected $collection = 'activities';
    protected $fillable = ['actor_id','verb','object','meta','created_at','board_id'];
    protected static function booted(){
        static::raw(fn($c)=>$c->createIndex(['board_id'=>1,'created_at'=>-1]));
    }
}
