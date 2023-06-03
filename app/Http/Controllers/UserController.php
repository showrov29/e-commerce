<?php

namespace App\Http\Controllers;
// namespace App\Http\Controllers\Exceptions;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Throwable;
use App\Exceptions;
use Exception;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    function register(Request $request){
        $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|email',
            'password' => 'required|max:20',
            'phone' => 'required|max:11',
            'address' => 'required',
            'nid'=>'required|mimes:pdf|max:1000',
            'dob'=>'required|date',

        ]);


        $var=new User();
        $nid=$request->file('nid')->store('uploads/user/nid');
        $var->name=$request->name;
        $var->email=$request->email;
        $var->password=md5($request->password);
        $var->phone=$request->phone;
        $var->address=$request->address;
        $var->nid=$nid;
        $var->dob=$request->dob;
    
        return $var->save();

    }
    function getAllUsers( ){

        
      
        return User::all();

    }
    function getUserInactive( ){


        return User::where('status',false)->get();

    }
    function setActive(int $id ){
        
        try{
            $user=User::find($id);

            $user->status=true;
            return $user->save();

        }
        catch(Exception $e){

        return $e ;
        }
    }
    function login(Request $request){
        
       $user=User::where("email",$request->email)->first();
            if ($user!=null){ 
                if ($user->password==md5($request->password)) {
                    if ($user->status==true) {
                        # code...
                     Session::put('userId',$user->id);
                        return session()->get('userId'); 
                    }
                    else{
                       return collect([
                            "message"=>"Your account is not authorized yet.",
                         ]);
                    }
                }
                else{
                    return collect([
                        "message"=>"Incorrect password",
                     ]);

                }
              
            }
           else {
            
                return collect([
                    "message"=>"No account is registered with this email address",
                 ]);
;
                }
      
      
      

        
    }
}
