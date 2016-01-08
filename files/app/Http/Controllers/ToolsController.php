<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateToolRequest;
use App\Http\Requests\UpdateToolRequest;
use App\Models\Technician;

use Mail;


class ToolsController extends Controller
{   
    public function __construct (){

         $this -> middleware('auth');
         $this -> middleware('tool', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // list of all tools

        if((\Auth::user()->admin == "No")&&(\Auth::user()->super == "No")){

            $tools= \Auth::user() -> tools()->orderBy('retag_date','ASC')->get();


        } else {

            $type = \Request::get("type");

            if(\Auth::user()->admin == "Yes"){
                if($type == "Personal"){
                    $tools= \Auth::user() -> tools()->where("type","=","Personal")->orderBy('retag_date','ASC')->get();

                }else{

                    $tools = \App\Models\Tool::whereIn("user_id",function($query){
                        $query->select('id')
                            ->from("users")
                            ->where('site_id',\Auth::user()->site_id);

                            // ->where(function ($query) {
                            //     $query->where('admin',"=","Yes")
                            //           ->orWhere('super',"=","Yes")
                            // });         
                    })->where("type","=","Company")->orderBy('retag_date','ASC')->get();
                }
                

            }

            if(\Auth::user()->super == "Yes"){

                if($type == "Personal"){
                    $tools= \Auth::user() -> tools()->where("type","=","Personal")->orderBy('retag_date','ASC')->get();

                }else{

                    $tools = \App\Models\Tool::whereIn("user_id",function($query){
                        $query->select('users.id')
                            ->from("users")
                            ->join("sites","site_id","=","sites.id")
                            ->where('company_id', \Auth::user()->site->company_id);       
                    })->where("type","=","Company")->orderBy('retag_date','ASC')->get();
                }
            }
        }

        return view('allTools',['tools' => $tools]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('addTool');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateToolRequest $request)
    {
        //

        $tool = \App\Models\Tool::create($request -> all());

        $tool -> save();


        if ($request -> input('tech_name') != NULL){
            $technician = Technician::create($request -> all());
            $tool -> technician_id = $technician -> id;
            $tool->save();
        }

        return redirect('tools/'.$tool -> id) ->with('message-success','Tool has been added.');
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
        $tool = \App\Models\Tool::find($id);

        return view('tool',['tool' => $tool]);
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
        $tool = \App\Models\Tool::find($id);
        return view('editTool',compact('tool'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateToolRequest $request, $id)
    {
        //

        $tool = \App\Models\Tool::find($id);

        $tool -> fill($request -> all());

        $type = \Request::get("type");

       // if company tool has been transferred
        $iPreviousSiteID = $tool ->user->site_id;

        if($tool->user->site_id != $request->get("site_id")){

            $iNewSiteID = \App\Models\Site::find($request->get("site_id"))->users()->where("admin","=","Yes")->first()->site_id;

            $tool->user_id = \App\Models\Site::find($request->get("site_id"))->users()->where("admin","=","Yes")->first()->id;
            
            // send notification
               
            $notification = new \App\Models\Notification();  
            $notification->message = '<a href="'.url("tools/".$tool -> id).'">'.$tool -> name.'</a>'." has been transferred to this job site.";
            $notification->user_id = $tool->user_id;
            $notification->save();

            //send email

            Mail::send('emails.transfers', ['tool' => $tool], function ($m) {
                $m->from('leanne.abarro@gmail.com', 'Tag and Track');
                $m->to('leanne.abarro@gmail.com', 'Leanne')->subject('Company Tool has been transferred');
            });

            // transfers table

            $transfer = new \App\Models\Transfer();
            $transfer -> previous_site_id = $iPreviousSiteID;
            $transfer -> current_site_id = $iNewSiteID;
            $transfer -> tool_id = $tool -> id;
            $transfer -> save();     
        }

        // reset notifications flags, when retag date changes

        if($tool -> retag_date != $request->get("retag_date")){

            $tool -> five_notice = 0;
            $tool -> three_notice = 0;
            $tool -> one_notice = 0;
        }

        $tool -> save();

        if ($request -> has('tech_name')){
            $name = $request -> get('tech_name');
            $company = $request -> get('tech_company');
            $phone= $request -> get('contact_number');

            $technician= \App\Models\Technician::where("tech_name",'=',$name)->where("tech_company",'=',$company)->where("contact_number",'=',$phone)->first();

            // if technician doesn't exist

            if($technician == false){
                $technician = Technician::create($request -> all());

            }

            $tool -> technician_id = $technician -> id;
            $tool->save();
        }

        if ($type == "Company"){

            return redirect('tools?type=Company') ->with('message-update','Update successful.');

        } else {
            
            return redirect('tools?type=Personal') ->with('message-update','Update successful.');
        }
        
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
