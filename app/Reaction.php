<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable =['book_id','user_id','likes','dislikes'];
     public function user(){
        return $this->belongsTo('App\User');
    }
    public function books(){
        return $this->belongsTo('App\Book','book_id','id');
    }
}
