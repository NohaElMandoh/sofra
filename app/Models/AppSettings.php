<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSettings extends Model 
{

    protected $table = 'app_settings';
    public $timestamps = true;
    protected $fillable = array('about_text', 'instagram_url', 'facebook_url', 'twitter_url', 'commission');

}