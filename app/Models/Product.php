<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('resturant_id', 'name', 'desc', 'price', 'preparation_time', 'product_img');

    public function order()
    {
        return $this->belongsToMany('Models\Order');
    }
    public function resturant()
    {
        return $this->belongsTo('App\Models\Resturant');
    }

}