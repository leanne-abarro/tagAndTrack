<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    //

    public function showDashboard (){

    	return view('dashboard');
    }

    public function noAccess (){

    	return view('noAccess');
    }
}
