<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'order_id', 'title_en', 'content_en');

    public function order()
    {
        return $this->belongsTo('Models\Order');
    }

    public function client()
    {
        return $this->belongsToMany('Models\Client');
    }

    public function resturant()
    {
        return $this->belongsToMany('Models\Resturant');
    }

}