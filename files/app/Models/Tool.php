<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Tool extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tools';


    protected $dates = ['serviced_date','retag_date'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','plant_number','serial_number','tag_number','type','serviced_date','retag_date','technician_id','user_id','five_notice','three_notice','one_notice'];

    //

    public function setServicedDateAttribute ($date){

        //dd($date);
         $this->attributes['serviced_date'] = Carbon::createFromFormat('d/m/Y', $date);
    }

    public function setRetagDateAttribute ($date){
         $this->attributes['retag_date'] = Carbon::createFromFormat('d/m/Y', $date);
    }

    public function user (){
    	return $this -> belongsTo('App\Models\User');
    }

    public function technician (){
    	return $this -> belongsTo('App\Models\Technician');
    }

    public function transfers (){
    	return $this -> hasMany('App\Models\Transfer');
    }

}
