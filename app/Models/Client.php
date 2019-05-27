<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'neighborhood_id', 'adderss_desc', 'password', 'api_token', 'code');

    public function neighborhood()
    {
        return $this->belongsTo('App\Models\Neighborhood','neighborhood_id');
    }

    public function make_order()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function notifications()
    {
        return $this->belongsToMany('Models\Notification');
    }
    protected $hidden = [
        'password', 'api_token','code'
    ];
}