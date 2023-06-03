<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    function getAllAdvertisement(){
        return Advertisement::get();
    }
    function addAdvertisement(Request $request){

        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image1'=>'required|mimes:jpg,png,jpeg|max:1000',
            'image2'=>'required|mimes:jpg,png,jpeg|max:1000',
            'image3'=>'required|mimes:jpg,png,jpeg|max:1000'

        ]);

        $var=new Advertisement();
        $var->type=$request->type;
        $var->name=$request->name;
        $var->description=$request->description;
        $var->price=$request->price;
        $var->user_id=$request->user_id;
        $var->image1=$request->file('image1')->store('uploads/');
        $var->image2=$request->file('image2')->store('uploads/advertisements');
        $var->image3=$request->file('image3')->store('uploads/advertisements');

        return $var->save();
    }



}
