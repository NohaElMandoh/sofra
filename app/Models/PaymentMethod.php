<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model 
{

    protected $table = 'payment_methods';
    public $timestamps = true;
    protected $fillable = array('name');

}