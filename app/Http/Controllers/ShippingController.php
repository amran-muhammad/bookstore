<?php

namespace App\Http\Controllers;
use App\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function add_shipping_information(Request $request){
        $data = $request->all();
        return Shipping::create($data);
    }
   
    public function show_shipping_information ($id) {

        return Shipping::where('id',$id)->first();
    }
}
