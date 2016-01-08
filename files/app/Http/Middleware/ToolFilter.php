<?php

namespace App\Http\Middleware;

use Closure;

class ToolFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

         $toolID = $request -> route('tools');

         $tool = \App\Models\Tool::find($toolID);

         $toolType = \App\Models\Tool::find($toolID) -> type;

         

         
         $userID = \App\Models\Tool::find($toolID) -> user_id;

         // any user trying to access personal tools
         if($toolType == "Personal"){


            if (\Auth::user() -> id != $userID){

                if ($request -> ajax()){
                    return response('Unauthorized', 401);
                } else {
                    return redirect() -> guest('noAccess');
                }
            }
         }

         // any user trying to access company tools

         if ($toolType == "Company"){


            // if a user is not an admin or a super

            if(\Auth::user() -> admin == "No" && \Auth::user() -> super == "No"){
               

                if ($request -> ajax()){
                    return response('Unauthorized', 401);
                } else {
                    return redirect() -> guest('noAccess');
                }
            }

            // if an admin user is trying to access a company tool that does not belong to their site

            if(\Auth::user() -> admin == "Yes") {

                if (\Auth::user() -> site_id != $tool -> user -> site_id) {

                  
                    if ($request -> ajax()){
                    return response('Unauthorized', 401);

                    } else {
                        return redirect() -> guest('noAccess');
                    }
                }
            }

            // if a super user is trying to access a company tool that does not belong to their company

            if (\Auth::user() -> super == "Yes") {

                if (\Auth::user() -> site -> company_id != $tool -> user -> site -> company_id) {
                    if ($request -> ajax()){
                    return response('Unauthorized', 401);

                    } else {
                        return redirect() -> guest('noAccess');
                    }
                }
            }

        } // end of $toolType == "Company" if statement
        
        return $next($request);

    } // end of public function handle 
}
