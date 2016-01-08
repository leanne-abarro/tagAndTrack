<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{	


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sites';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','address','contact_person', 'contact_number', 'company_id'];
    
    //
    public function company (){
    	return $this -> belongsTo('App\Models\Company');
    }

    public function users (){
    	return $this -> hasMany('App\Models\User');
    }
}
