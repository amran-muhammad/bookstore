<?php

namespace App\Http\Controllers;
use App\Book;

use App\BookReview;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create_book(Request $request){
        $data = $request->all();
        return Book::create($data);
    }
    
    public function all_books(){
    
        
        return Book::with('category','author','average')->get();
    }
    public function show_book_long ($id) {

        return Book::where('id',$id)->with('author','reviewAndRating','reviewAndRating.user','total_likes','total_dislikes','reaction')->first();
    }
    
    public function all_books_of_this_category ($id) {
        return Book::where('category_id',$id)->with('author')->get();
    }
    public function all_books_of_this_author ($id) {
        return Book::where('author_id',$id)->with('category')->get();
    }
     //add review and rating
    
     public function add_review_rating(Request $request){
        $data = $request->all();

        return BookReview::create($data);
    }
    //update a review and rating 
     public function update_review_rating(Request $request){
        $data = $request->all();

        return BookReview::where('id',$data['id'])->update($data);
    }
     //delete a review and a ratng
     public function delete_review_rating(Request $request){
        $data = $request->all();
        return BookReview::where('id',$data['id'])->delete();
    }
}
