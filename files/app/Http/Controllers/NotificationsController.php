<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NotificationsController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function index()
    {
        $notifications = \App\Models\Notification::orderBy('created_at','DESC') -> where('user_id',\Auth::user()->id)->where("has_read","=","No") -> get();

        return view('notifications', ['notifications' => $notifications]);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    
    }


     public function update(Request $request, $id)
    {

        $notification = \App\Models\Notification::find($id);

        $notification -> fill($request -> all());

        $notification -> save();

        return view('notifications', ['notifications' => $notifications]);


    }



}
