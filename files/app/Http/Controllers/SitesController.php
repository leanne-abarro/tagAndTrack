<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateJobSiteRequest;
use App\Http\Requests\UpdateJobSiteRequest;

class SitesController extends Controller
{
    public function __construct (){
         $this -> middleware('auth', ['except' => ['create','store']]);
         //$this -> middleware('site', ['except' => ['create','store']]);
         $this -> middleware('site', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        if(\Auth::user()->super == "Yes") {

            $sites = \App\Models\Site::whereIn("id",function($query){
                $query->select('sites.id')
                    ->from("sites")
                    ->where('company_id', \Auth::user()->site->company_id);       
            })->get();  
        }

        return view('allSites',['sites' => $sites]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('addSite');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateJobSiteRequest $request)
    {
        //

        $site = \App\Models\Site::create($request -> all());
        $site -> save();

        return redirect('sites/'.$site -> id) ->with('message-success','Job site has been added.');
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
        $site = \App\Models\Site::find($id);
        
        return view('jobSiteProfile',['site' => $site]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $site = \App\Models\Site::find($id);
        return view('editJobSiteProfile', compact('site'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobSiteRequest $request, $id)
    {
        //
        $site = \App\Models\Site::find($id);
        $site -> fill($request -> all());

        $site -> save();

        return redirect('sites/'.$site -> id) ->with('update-success','Job Site has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
