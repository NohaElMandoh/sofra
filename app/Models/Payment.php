<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model 
{

    protected $table = 'payments';
    public $timestamps = true;
    protected $fillable = array('resturant_id', 'val', 'payment_date');

}