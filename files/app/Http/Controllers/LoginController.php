<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

class LoginController extends Controller
{


    // show login form
    
    public function showLoginForm (){

    	return view("login");
    }
    
    // process login
    
    public function processLogin (Guard $auth,Request $request){
        
        //get credentials

        $credential = $request -> only("username","password");



        // get the guard


        if ($auth -> attempt($credential)){ // can log in

            //return redirect() -> intended('users/'. $auth ->user()->id);

            return redirect('dashboard');

        
            
        } else { 

            return redirect('login') -> with("message","Username or password doesn't match. Try again.");
            
        }

        
    }

    public function logout (Guard $auth){

        $auth -> logout();
        return redirect ('login') -> with("logout-message", "You have now logged out.");
    }
}
