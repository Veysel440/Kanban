<?php

namespace App\Models\Mongo;

class Card extends BaseMongoModel {
    protected $collection = 'cards';
    protected $fillable = ['list_id','title','desc','tags','assignees','due_at','order'];
    protected static function booted(){
        static::raw(fn($c)=>$c->createIndex(['list_id'=>1,'order'=>1]));
        static::raw(fn($c)=>$c->createIndex(['assignees'=>1]));
        static::raw(fn($c)=>$c->createIndex(['due_at'=>1]));
    }
}
