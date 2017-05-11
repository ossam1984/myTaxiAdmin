<?php

namespace App\Http\Controllers;
// use App\Models\AppUser;
// use App\Models\AppUser;
use Illuminate\Http\Request;
use \App\Http\Requests\UserRegisterRequest;
class UserCtrl extends Controller
{
    //


	// Try Indexing
	/**
	 * This is the indexes api
	 *
	 * @return api Wel
	 * @author Hisham
	 **/
	public function index()
	{
		return ["welcom"];
	}

	/**
	 * Create New User
	 *
	 * Api Or site Create new user by type driver or customer or admin
	 * parm in array $request
	 * @param String first_name first name of user
	 * @param String last_name last name of user
	 * @param Integer gender 1 if man and 2 if women
	 * @param string owner_type the type of user 
	 * @param String email the email of user 
	 * @param String phone the phone of user 
	 * @param String password the password of user if he/she need it
	 **/
	public function create(UserRegisterRequest $request)
	{
		$data = $request->only(["first_name","last_name","gender","password","email","phone","dev_token","dev_id"]);
		if($request->get("owner_type")===\App\Customer::class){
			$user = $this->createCustomerUser(["name"=>$request->get("first_name"). " " .$request->get("last_name")]);
			// return "GOOD Customer";
		}
		elseif($request->get("owner_type")===\App\Driver::class){
			$user = $this->createDriverUser(["name"=>$request->get("first_name"). " " .$request->get("last_name")]);
			// return "GOOD";
			
		}
		$data["password"] = bcrypt($data["password"]);
		$user =  \App\User::create(array_merge($data,$user));
		return response()->json($user, 200);
		
	}


	/**
	 * Create User of type Customer
	 *
	 * Create Customer Field In customers table and return the id of created user
	 *
	 * @param return only id of created user
	 **/
	private function createCustomerUser($data)
	{
		$customer =  \App\Customer::create($data);
		return ["owner_type"=>\App\Customer::class,"owner_id"=>$customer->id];
	}
	
	
	/**
	 * Create User of type Driver
	 *
	 * Create Driver Field In drivers table and return the id of created user
	 *
	 * @param return only id of created user
	 **/
	private function createDriverUser($data)
	{
		$driver =  \App\Driver::create($data);
		return ["owner_type"=>\App\Driver::class,"owner_id"=>$driver->id];
	}


	public function lamp(){
		return ["How"];
	}



	/**
	 * Get Driver information
	 *
	 * get driver information by id 
	 *
	 * @param interger id Drvier id in driver table
	 **/
	public function DriverInfo(Request $request)
	{
		return \App\User::find($request->get("id"));
	}


}
