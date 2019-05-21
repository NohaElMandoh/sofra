<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model 
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('resturant_id', 'title', 'desc', 'price', 'from', 'to', 'img');

    public function resturant()
    {
        return $this->belongsTo('App\Models\Resturant');
    }

}