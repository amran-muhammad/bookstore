<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name','details','price','author_id','category_id','isbn_number','language'
    ];
    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function author(){
        return $this->belongsTo('App\User');
    }
    
    public function reaction(){
        return $this->hasMany('App\Reaction');
    }
     public function reviewAndRating(){
        return $this->hasMany('App\BookReview');
    }
    public function average(){
        return $this->hasOne('App\BookReview')->select('book_id',DB::raw('avg(rating) as averageRating'))->groupBy('book_id');
    }
     public function total_likes(){
        return $this->hasOne('App\Reaction')->select('book_id',DB::raw('sum(likes) as totalLikes'))->groupBy('book_id');
    }
    public function total_dislikes(){
        return $this->hasOne('App\Reaction')->select('book_id',DB::raw('sum(dislikes) as totalDislikes'))->groupBy('book_id');
    }
}



