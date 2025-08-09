<?php

namespace App\Models\Mongo;

class Board extends BaseMongoModel {
    protected $collection = 'boards';
    protected $fillable = ['name','members','created_at'];
}
