<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //

    protected $fillable = ['message','user_id','has_read'];

    public function user (){
    	return $this -> belongsTo('App\Models\User');
    }
}
