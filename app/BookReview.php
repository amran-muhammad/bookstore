<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookReview extends Model
{
    protected $fillable =['comment','book_id','user_id','rating'];
    public function user(){
       return $this->belongsTo('App\User');
   }
}
