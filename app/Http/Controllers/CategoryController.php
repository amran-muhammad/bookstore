<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function all_category(){
        return Category::all();
    }
    
    public function create_category( Request $request){
        $data = $request->all();
        return Category::create($data);
    }
}
