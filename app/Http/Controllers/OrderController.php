<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Payments;




use Illuminate\Http\Request;

class OrderController extends Controller
{
    function getOrders(){
        $x = new Orders();
        return  Orders::with('payment')->get();
    }
    function getOrderByOrderId(int $id){
        $x = new Orders();
        return  Orders::with('payment')->find($id);
    }
    function confirmOrder( int $id ){
        $x = Orders::find($id);
        $x->status=false;
        return $x->save();
        
    }
    function addOrder(Request $request,int $advertisementId){
        $request->validate([

            'eamil'=>'required|email',
            'phone'=>'required|max:11',
            'address'=>'required',
            'transaction'=>'required|max:10'

        ]);
      

        $x = new Orders();
        $x->advertisement_id=$advertisementId;
        $x->email=$request->eamil;
        $x->phone=$request->phone;
        $x->address=$request->address;
        $x->transaction_id=$request->transaction_id;
       
        return $x->save()  ;
    }
}
