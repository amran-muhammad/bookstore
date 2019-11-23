<?php

namespace App\Http\Controllers;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create_order(Request $request){
        $data = $request->all();
        return Order::create($data);
    }
    
public function all_orders(){
    return Order::all();
}
}
