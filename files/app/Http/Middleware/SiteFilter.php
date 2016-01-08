<?php

namespace App\Http\Middleware;

use Closure;

class SiteFilter
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
        $siteID = $request -> route('sites');
        $site = \App\Models\Site::find($siteID);

        // normal and admin users accessing other site info

        if(\Auth::user() -> super == "No") {

            if (\Auth::user() -> site_id != $siteID){

                if ($request -> ajax()){
                    return response('Unauthorized', 401);
                } else {

                    return redirect() -> guest('noAccess');
                }

            }
        }

        // if super user is trying to access a site belonging to another company

        if(\Auth::user() -> super == "Yes") {

            if (\Auth::user() -> site -> company_id != $site -> company_id) {
                if ($request -> ajax()){
                return response('Unauthorized', 401);

                } else {
                    return redirect() -> guest('noAccess');
                }
            }
        }
 
        return $next($request);
    }
}

