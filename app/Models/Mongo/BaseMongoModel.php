<?php

namespace App\Models\Mongo;
use Illuminate\Database\Eloquent\Model;


abstract class BaseMongoModel extends Model {
    protected $connection = 'mongodb';
    public $timestamps = false;
}
