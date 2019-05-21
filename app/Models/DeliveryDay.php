<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryDay extends Model 
{

    protected $table = 'delivery_days';
    public $timestamps = true;
    protected $fillable = array('name');

    public function resturant()
    {
        return $this->belongsToMany('Models\Resturant');
    }

}