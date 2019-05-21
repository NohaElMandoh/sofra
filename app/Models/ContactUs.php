<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model 
{

    protected $table = 'contact_us';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'msg', 'msg_category');

}