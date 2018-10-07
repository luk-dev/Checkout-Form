<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Checkout extends Model
{

    protected $table = 'forms'; 
    protected $fillable = ['name', 'email', 'content'];
}