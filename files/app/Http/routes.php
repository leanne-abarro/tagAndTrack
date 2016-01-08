<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {

});


// ===== auto complete routes =====

Route::get('toolnames',function(){

	$toolnames = collect(\App\Models\Tool::lists("name"));

	return $toolnames->unique()->values()->all();
});

Route::get('technames',function(){

	$technames = collect(\App\Models\Technician::lists("tech_name"));

	return $technames->unique()->values()->all();
});

Route::get('techcompanies',function(){

	$techcompanies = collect(\App\Models\Technician::lists("tech_company"));

	return $techcompanies->unique()->values()->all();
});

Route::get('technumbers',function(){

	$technumbers = collect(\App\Models\Technician::lists("contact_number"));

	return $technumbers->unique()->values()->all();
});

// ===== donut charts routes =====

Route::get('countnotifications',function(){

	$user = \Auth::user();

	$usernotifications = $user -> notifications -> where('has_read','No') -> count();

	return $usernotifications;
});

Route::get('countpersonaltools',function(){

	$user = \Auth::user();

	$usertools = $user -> tools() -> where('type','Personal') -> count();

	return $usertools;
});

Route::get('countcompanytools',function(){

	$user = \Auth::user();

	if ($user -> admin == 'Yes') {
		$companytools = \App\Models\Tool::whereIn("user_id",function($query){
            $query->select('id')
                ->from("users")
                ->where('site_id',\Auth::user()->site_id);       
        })->where("type","=","Company")-> count();
	} else {

		$companytools = \App\Models\Tool::whereIn("user_id",function($query){
                        $query->select('users.id')
                            ->from("users")
                            ->join("sites","site_id","=","sites.id")
                            ->where('company_id', \Auth::user()->site->company_id);       
                    })->where("type","=","Company")->count();
	}

	return $companytools;	
});

Route::get('countduepersonaltools',function(){

	$user = \Auth::user();

	$FiveDaystoGo = \Carbon\Carbon::now()->addDays(5)->format("Y-m-d");

	$usertools = $user -> tools() -> where('type','Personal') ->where("retag_date","<=",$FiveDaystoGo )-> count();

	return $usertools;
});

Route::get('countduecompanytools',function(){

	$user = \Auth::user();

	$FiveDaystoGo = \Carbon\Carbon::now()->addDays(5)->format("Y-m-d");

	if ($user -> admin == 'Yes') {
		$companytools = \App\Models\Tool::whereIn("user_id",function($query){
            $query->select('id')
                ->from("users")
                ->where('site_id',\Auth::user()->site_id);       
        })->where("type","=","Company")->where("retag_date","<=",$FiveDaystoGo )-> count();
	} else {

		$companytools = \App\Models\Tool::whereIn("user_id",function($query){
                        $query->select('users.id')
                            ->from("users")
                            ->join("sites","site_id","=","sites.id")
                            ->where('company_id', \Auth::user()->site->company_id);       
                    })->where("type","=","Company")->where("retag_date","<=",$FiveDaystoGo )-> count();

	}

	return $companytools;
});

Route::get('countusers',function(){

	$user = \Auth::user();

	if ($user -> admin == 'Yes') {
		$users = \App\Models\User::whereIn("id",function($query){
                    $query-> select('id')
                          -> from("users")
                          -> where('site_id',\Auth::user()->site_id);      
                    })-> count();
	} else {

		$users = \App\Models\User::whereIn("id",function($query){
                $query-> select('users.id')
                    -> from("users")
                    -> join("sites","site_id","=","sites.id")
                    -> where('company_id', \Auth::user()->site->company_id);       
            })-> count();       
	}

	return $users;	
});

Route::get('countsites',function(){

	 $sites = \App\Models\Site::whereIn("id",function($query){
                $query->select('sites.id')
                    ->from("sites")
                    ->where('company_id', \Auth::user()->site->company_id);       
            })-> count();  
	return $sites;	
});


// ===== email routes =====



// ===== login and logout routes =====

Route::get('login','LoginController@showLoginForm');

Route::post('login', 'LoginController@processLogin');

Route::get('logout', 'LoginController@logout');


// ===== users routes =====

Route::resource('users','UsersController');

// ===== tools routes =====

Route::resource('tools','ToolsController');

// ===== sites routes =====

Route::resource('sites','SitesController');

// ===== notifications routes =====

Route::resource('notifications','NotificationsController');

// ===== pages (other) routes =====

Route::get('dashboard','PagesController@showDashboard');

Route::get('noAccess','PagesController@noAccess');
