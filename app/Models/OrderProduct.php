<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model 
{

    protected $table = 'order_product';
    public $timestamps = true;
    protected $fillable = array('order_id', 'product_id', 'count', 'special_order', 'total_price');

}