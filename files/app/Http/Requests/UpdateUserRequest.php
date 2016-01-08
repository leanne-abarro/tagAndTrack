<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if($this->ajax() == false){

            if($this->input("submit")=="Update"){

                return [
                //

                    "username" => "required|unique:users,username,".$this->route('users'),
                    "email" => "required|unique:users,email,".$this->route('users'),
                    "firstname" => "required",
                    "lastname" => "required"
                ];

            }else{

                return [
                //
                    "password" => "required|confirmed",
                    "old_password"=>"required"
                ];

            }

        }else{
            return [];

        }

        
    }
}
