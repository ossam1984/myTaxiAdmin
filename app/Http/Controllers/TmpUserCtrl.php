<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class TmpUserCtrl extends Controller
{
    //

    // $fillable 

    /**
     * Save Data Of register user tempor before conformation
     *
     * @return API json data
     * @author Hisham Ahmed Nasher
     **/
    public function saveDataTmp(Requests\PhoneRequest $request)
    {
    	// Check if user is in users 
        $is_user= \App\AppUser::wherePhone($request->get('phone'))->first();

        if($is_user){
            $new_user = $is_user;
        }
        else{

            $new_user = \App\TmpUser::create($request->all());
        

            
        }








        //if user created in tmp table then create confrmation code 
        $conformation = $this->createConfCode();  


        // Save Conformation to the user
        $new_user->activ_code = $conformation;
        // Send it to user
        $this->send($conformation,$new_user->phone);



        $response = [

            "state" => ["b"=>"CREATED"] ,
            "id" => $new_user->id,
            "dev_id" => $new_user->dev_id,
            "code" => $conformation,
            "new_user" => !$is_user?true:false,
            "end_time" => time(),


        ];

        return $response;


    }


    /**
     * Create Conformation Code For User
     *
     * @return string
     * @author Hisham Ahmed Nasher Alkobati
     **/
    private function createConfCode()
    {
        return '12333';






    }


    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    private function send($code,$phone){}
    
}
