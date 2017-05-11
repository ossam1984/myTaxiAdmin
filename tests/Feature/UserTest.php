<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
        use DatabaseMigrations;

        public function testDriverCanGenrateAccount()
        {
            $new_user = [
                "first_name" => "Hisham",
                "last_name" => "Ahmed",
                "phone" => "772077550",
                "gender" => 1,
                "email" => "h.alkobati@gmail.com",
                "owner_type"=>\App\Driver::class,
                "dev_id"=>"123321123321123321123321",
                "password"=>"123321123321123321123321"

            ];

            $driver = [
                "driver_licence_no"=>"123123123",
                "driver_licence_expire_date"=>"123123123",
                
            ];

            // dd(array_merge($new_user,$driver));
            $res = $this->json("POST","en/api/user/register",array_merge($new_user,$driver));
            $res->assertStatus(200);
            unset($new_user["password"]);
            unset($new_user["dev_id"]);
            unset($new_user["owner_type"]);
            unset($new_user["gender"]);
            $this->assertDatabaseHas("users",$new_user);
            
            $this->assertDatabaseHas("drivers",["name"=>"Hisham Ahmed"]);
        }    
        public function testCustomerCanGenrateAccount()
        {
            $new_user = [
                "first_name" => "Hisham",
                "last_name" => "Ahmed",
                "phone" => "772077550",
                "gender" => 1,
                "email" => "h.alkobati@gmail.com",
                "owner_type"=>\App\Customer::class,
                "dev_id"=>"123321123321123321123321",
                "password"=>"123321123321123321123321"

            ];

            $res = $this->json("POST","en/api/user/register",$new_user);
            $res->assertStatus(200);
            $new_user["password"] = bcrypt($new_user["password"]);
            unset($new_user["password"]);
            // unset($new_user["dev_id"]);
            // unset($new_user["owner_type"]);
            // unset($new_user["gender"]);
            // unset($new_user["password"]);
            // unset($new_user["password"]);
            $this->assertDatabaseHas("users",$new_user);
            $this->assertDatabaseHas("customers",["name"=>$new_user["first_name"]." ".$new_user["last_name"]]);
            
        }    

}
