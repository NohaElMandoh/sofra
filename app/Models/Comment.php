<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model 
{

    protected $table = 'comments';
    public $timestamps = true;
    protected $fillable = array('resturant_id', 'desc', 'stars');

    public function resturant()
    {
        return $this->belongsTo('Models\Resturant');
    }

}