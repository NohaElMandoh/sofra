<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('client_id','resturant_id', 'delivery_time', 'delivery_date', 'delivery_address', 'notes', 'total_price', 'delivery_status_resturant', 'status', 'delivery_status_client', 'payment_method_id');

    public function products()
    {
        return $this->belongsToMany('Models\Product');
    }

    public function notifications()
    {
        return $this->hasMany('Models\Notification');
    }

    public function clients()
    {
        return $this->belongsToMany('Models\Client');
    }

}