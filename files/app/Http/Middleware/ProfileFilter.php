<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class ProfileFilter
{

    protected $guard; // stores injected guard object

    public function __construct (Guard $guard){
        $this -> guard = $guard; // store dependency into here
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $profileID = $request -> route('users');

        // $toolIDUser = $request -> route('tools' -> 'user_id');

        // if($this -> guard -> user()-> super == "No"){

            if ($this -> guard -> user() -> id != $profileID){

                if ($request -> ajax()){
                    return response('Unauthorized', 401);
                } else {
                    return redirect() -> guest('noAccess');
                }
            }  
        // }

        // if ($this -> guard -> user() -> super == "Yes"){

        //     if ($this -> guard -> user() -> site -> company_id != $profileID -> site -> company_id){

        //         if ($request -> ajax()){
        //             return response('Unauthorized', 401);
        //         } else {
        //             return redirect() -> guest('noAccess');
        //         }
        //     }

        // }

        return $next($request);


    }
}
