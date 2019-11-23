<?php

namespace App\Http\Controllers;
use App\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function add_reaction(Request $request){
         $data = $request->all();
        // return Reaction::create($data);
        
        $reaction = Reaction::updateOrCreate(['user_id' => $data['user_id'],'book_id' =>$data['book_id']],['likes'=>$data['likes'],'dislikes'=>$data['dislikes']]);
        return $reaction;
        
    }
}