<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    //

    public function tool (){

    	return $this -> belongsTo('App\Models\Tool');
    }
}
