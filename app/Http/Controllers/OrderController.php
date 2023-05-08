<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Payments;




use Illuminate\Http\Request;

class OrderController extends Controller
{
    function getOrders(){
        $x = new Orders();
        return  Orders::all();
    }
    function getOrderByOrderId(int $id){
        $x = new Orders();
        return  Orders::with('payment')->find($id);
    }
    function editOrder( int $id ){
        $x = Orders::find($id);
        $x->status=false;
        return $x->save();
    }
    function addOrder(Request $request){
        $x = new Orders();
        return  ;
    }
}
