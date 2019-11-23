<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
        'first_name','last_name', 'email', 'phone1','phone2','country','city','area','address','user_id'
    ];
}
