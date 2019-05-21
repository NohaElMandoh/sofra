<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryDayResturant extends Model 
{

    protected $table = 'delivery_days_resturants';
    public $timestamps = true;
    protected $fillable = array('delivery_day_id', 'resturant_id');

}