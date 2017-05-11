<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class UserAppCtrl extends Controller
{
    //


    /**
     * Register - first step - send Conformation Code
     *
     * @return Api Json Data
     * @author Hisham Ahmed Nasher
     **/
    public function conformation($lang="en",Requests\ConfRequest $request)
    {
        // sleep(5);
    	$gen = new \App\Helpers\ConfGenrator();

    	$code = $gen->gen(); 
        $end_time = date("Y-m-d H:i:s",strtotime("now+1hour"));

        $user = \App\TmpUser::wherePhone($request->get('phone'))->first();
        if($user){

        $tmp_user = $user;
        $tmp_user->code = $code;
        $tmp_user->end_time = $end_time;
        }
        else{

    	$tmp_user = \App\TmpUser::create([
    		'phone'=>$request->get('phone'),
    		'first_name'=>$request->get('first_name'),
    		'last_name'=>$request->get('last_name'),
    		'user_type'=>$request->get('user_type'),
    		'email'=>$request->get('email'),
    		'code'=>$code,
            "dev_id"=>$request->get('dev_id'),
            "dev_token"=>$request->get('dev_token'),
            "end_time" =>$end_time,
            "gender" =>$request->get("gender"),


    	]);
        }
        

        

    	return [
    		'st' => "OK",
    		'data' =>[
    				'id'=>1,
    				'phone'=>$request->get('phone'),
    				'dev_id'=>$request->get('dev_id'),
    				'code'=>$code,
    				'end_time'=>date(strtotime('now+1hour'))

    				],
            'user_data'=>$tmp_user
    	];
    	// return "Hisham";
    }


    /**
     * After Confirmation the phone register user and added to AppUser Model
     *
     * @return return information about user added in AppUser in JSON API
     * @author Hisham Ahmed Nasher Alkobati
     **/
    public function register($lang="en",Requests\RegisterRequest $request)
    {
        // sleep(5);

    	// If user exist (Check By Phone Number)
    	$is_exist = \App\AppUser::wherePhone($request->get('phone'))->whereOwnerType($request->get('owner_type'))->first();
    	if($is_exist){
    		// return information About user
    		return $this->userInformation($is_exist);
    	}
    	else{
    		// create new User 
    		return $this->createNewUser($request);
    	}

    }


    /**
     * active user 
     *
     * Active user when enter his active code that send to him with SMS         
     *
     * @param JSON DATA
     **/
    public function make_active($lang="en",Requests\RegisterRequest $req)
    {
        $tmp_id = $req->get('tmp_id');
        $tmp_user = \App\TmpUser::find($tmp_id);

        // Chicked If user is register befor
        $is_user = \App\User::with("owner")->wherePhone($req->get('phone'))->first();
        
        if($is_user){
            
            return [
                'st'=>'CREATED',
                'data'=>$is_user,

            ];
        }
        else{
            if($tmp_user){
            
            if($tmp_user->user_type===\App\Customer::class){
                   // Create User As Customer
                   $owner_user = \App\Customer::create([
                        'name' => $req->get('first_name')+ " " +$req->get('last_name'),

                   ]);
            }
            else{
                // Create User As Driver
                $owner_user = \App\Driver::create([
                        'name' => $req->get('first_name')+ " " +$req->get('last_name'),

                ]);
            }
            $user = \App\User::create([
                    
                    'first_name'=>$tmp_user->first_name,
                    'last_name'=>$tmp_user->last_name,
                    'phone'=>$tmp_user->phone,
                    'email'=>$tmp_user->email?$tmp_user->email:"",
                    'owner_type'=>$tmp_user->user_type,
                    'owner_id'=>$owner_user->id,
                    'dev_id'=>$tmp_user->dev_id,
                    'dev_token'=>$tmp_user->dev_token,
                    
                

            ]);
            if($user){
                // $tmp_user->delete();
                // $tmp_user->save();
            }
            return [
                'st' => "NEW",
                'data' => $user

            ];
        }
        else{
            return [
                'st'=>"ERROR",
                'data'=>"Error In Your Code",

            ];
        }
        }
        


        # code...
    }

    


    /**
     * Return Information (Existing User)
     *
     * @return Api Json Data
     * @author Hisham Ahmed Nasher
     **/
    private function userInformation($is_exist)
    {   
        $is_exist->first_name =  $is_exist->first_name;
        $is_exist->last_name =  $is_exist->last_name;
        $is_exist->email =  $is_exist->email;
        $is_exist->dev_id =  $is_exist->dev_id;
        $is_exist->dev_token =  $is_exist->dev_token;
        
        $is_exist->dev_token =  $is_exist->dev_token;
        $is_exist->owner = $is_exist->owner;

        if($is_exist->owner_type===\App\Customer::class){
            \App\Customer::whereId($is_exist->owner_id)->update([
                'name'=> $is_exist->first_name." ".$is_exist->last_name
            ]);

        }else{
             \App\Driver::whereId($is_exist->owner_id)->update([
                'name'=> $is_exist->first_name." ".$is_exist->last_name
                // 'name'=> $is_exist->first_name." ".$is_exist->last_name
            ]);
        }
    	return [
    		'st' => 'EXIST',
    		'data'=>$is_exist,
    	];
    }


    /**
     * Create New User In the system however
     *
     * @return void
     * @author 
     **/
    private function createNewUser($req)
    {
    	if( $req->get('owner_type')===\App\Customer::class )
    	{
    		// Here Create User As Customer
    		$data = $this->createCustomerUser($req);
    	}
    	else{
    		// Here Create User As Driver
    		$data = $this->createDriverUser($req);

    	}

    	return [
    		'st' => 'NEW',
    		'data' => $data

    	];
    }


    /**
     * Create Customer Account
     *
     * @return return Information About The user 
     * @author Hisham Ahmed Nasher
     **/
    private function createCustomerUser($req)
    {
    	$customer = \App\Customer::create([
    		'name' => $req->get('first_name'). ' ' . $req->get('last_name'),
    	]);

    	// create Pivot Table AppUser

    	$user = \App\AppUser::create([
    		'owner_type' => \App\Customer::class,
    		'owner_id' =>  $customer->id,
    		'first_name' => $req->get('first_name'),
    		'last_name' => $req->get('last_name'),
    		'phone' => $req->get('phone'),
    		'email' => $req->get('email')==="null@null.null"?"":$req->get('email'),
    		'dev_id' => $req->get('dev_id'),
    		'dev_token' => $req->get('dev_token'),
    		'info' => $req->get('info')
    		]);
        $user->owner = $user->owner;
    	return $user;
    }



    /**
     * Create Driver Account 
     *
     * @return return information about the user
     * @author Hisham Ahmed Nasher
     **/
    private function createDriverUser($req)
    {
    		$driver = \App\Driver::create([
                'name' => $req->get('first_name'). ' ' . $req->get('last_name'),
                'driver_id_number' => $req->get('driver_id_number'),
    			'driver_id_expire' => $req->get('driver_id_expire'),
    		]);

    	// Create Pivot Table AppUSer



        $user = \App\AppUser::create([
            'owner_type' => \App\Driver::class,
            'owner_id' =>  $driver->id,
            'first_name' => $req->get('first_name'),
            'last_name' => $req->get('last_name'),
            'phone' => $req->get('phone'),
            'email' => $req->get('email')==="null@null.null"?"":$req->get('email'),
            'dev_id' => $req->get('dev_id'),
            'dev_token' => $req->get('dev_token'),
            'info' => $req->get('info')
            ]);
        $user->owner = $user->owner;
 		return $user;
    }



    /**
     * Update Device token to send notfications when device updated
     *
     * @return New Token To Sortit to device
     * @author Hisham Ahmed Nasher Alkobati
     **/
    public function updateToken(Request $request)
    {
        // Find User To update his/her device token
        $user = \App\AppUser::whereId($request->get('user_id'))->where("dev_id",$request->get('dev_id'))->first();

        if($user){

        $user->dev_token = $request->get('dev_token');

        $user->save();
        }
        else{
            return [
                'st'=>"ERROR",
                'data'=>[]
            ];
        }

        // return all user information

        return [
            'st'=>"OK",
            'data'=>$user,
        ];
    }
}
