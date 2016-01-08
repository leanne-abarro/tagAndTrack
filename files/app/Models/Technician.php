<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    //
    public function tools (){
    	return $this -> hasMany('App\Models\Tool');
    }

     protected $fillable = ['tech_name','tech_company', 'contact_number'];
}
