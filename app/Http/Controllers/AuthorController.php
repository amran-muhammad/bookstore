<?php

namespace App\Http\Controllers;
use App\Author;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function add_details_of_author(Request $request){
        $data = $request->all();
        return Author::updateOrCreate(['user_id' => $data['user_id']]
        ,['details'=>$data['details']]);

        
    }
}
