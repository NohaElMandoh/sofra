<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class NotifationResturant extends Model 
{

    protected $table = 'notifation_resturant';
    public $timestamps = true;
    protected $fillable = array('resturant_id', 'notification_id');

}