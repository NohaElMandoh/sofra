<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryWay extends Model 
{

    protected $table = 'delivery_ways';
    public $timestamps = true;
    protected $fillable = array('name');

    public function resturant()
    {
        return $this->hasMany('App\Models\Resturant');
    }

}