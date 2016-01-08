<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{   

    public function __construct (){
        $this -> middleware('auth', ['except' => ['create','store']]);
        $this -> middleware('profile', ['except' => ['create','store']]);
        $this -> middleware('profile', ['only' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(\Auth::user()->admin == "Yes") {
            $users = \App\Models\User::whereIn("id",function($query){
                    $query->select('id')
                          ->from("users")
                          ->where('site_id',\Auth::user()->site_id);      
                    })->get();
        }

        if(\Auth::user()->super == "Yes"){

            $users = \App\Models\User::whereIn("id",function($query){
                $query->select('users.id')
                    ->from("users")
                    ->join("sites","site_id","=","sites.id")
                    ->where('company_id', \Auth::user()->site->company_id);       
            })->get();       
        }

        return view('allUsers',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('createUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        //

        $user = \App\Models\User::create($request -> all());

        // encrypt password

        $user -> password = bcrypt($user -> password);

        $user -> save();

        return redirect('login') ->with('message-success','You are now registered, please login');
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
        $user = \App\Models\User::find($id);
        
        return view('profile',['user' => $user]);
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
        $user = \App\Models\User::find($id);
        return view('editProfile', compact('user')); // same as ['user' => $user]
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)

    {
        //
        $user = \App\Models\User::find($id);
        if($request->ajax() == false){

            
            $oldPassword = $user->password;

            $user -> fill($request -> all());
            
            
            if($request->input("submit")== "Change"){ 


                if(\Hash::check($request->input("old_password"),$oldPassword)){
                    $user -> password = bcrypt($user -> password);
                }else{
                    
                    return redirect('users/'.$user -> id.'/edit') ->with("old_password_message","Current password does not match. Please try again.");

                }
            }

            //move file from temp location to images
            if($request->hasFile("image")){
                $filename = \Carbon\Carbon::now() -> timestamp."_user_image.jpg";

                $request -> file ('image') -> move('images', $filename);

                $user -> image = $filename;
            }

            $user -> save();

            return redirect('users/'.$user -> id) -> with('update-success','Update Successful.');

        }else{

            $user->admin = $request->get('value');
            $user->save();
            return $user->admin;
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
