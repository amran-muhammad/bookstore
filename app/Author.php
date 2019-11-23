<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'details','user_id'
    ];
    
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
