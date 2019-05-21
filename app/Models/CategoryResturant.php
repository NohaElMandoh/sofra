<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class CategoryResturant extends Model 
{

    protected $table = 'category_resturant';
    public $timestamps = true;
    protected $fillable = array('category_id', 'resturant_id');

}