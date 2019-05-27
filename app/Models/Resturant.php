<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resturant extends Model 
{

    protected $table = 'resturants';
    public $timestamps = true;
    protected $fillable = array('neighborhood_id', 'name', 'email',
        'delivery_way_id', 'delivery_fee', 'minimum_order', 'phone', 'whatsapp_link', 'img', 'status', 'password', 'api_token', 'delivery_time','code');

    public function neighborhood()
    {
        return $this->belongsTo('App\Models\Neighborhood','neighborhood_id');
    }
    public function hasCategory()
    {
        return $this->belongsToMany('App\Models\Category');
    }
    public function order()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function make_offer()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function pay()
    {
        return $this->hasMany('Payment', 'resturant_id');
    }

    public function deliveryDay()
    {
        return $this->belongsToMany('Models\DeliveryDay');
    }

    public function deliveryway()
    {
        return $this->belongsTo('App\Models\DeliveryWay', 'delivery_way_id');
    }

    public function has_comments()
    {
        return $this->hasMany('Models\Comment');
    }

    public function notifications()
    {
        return $this->belongsToMany('Models\Notification');
    }
    protected $hidden = [
        'password', 'api_token','code'
    ];
}