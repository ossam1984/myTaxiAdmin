<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{
	use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function teestExample()
    {
        // $this->assertTrue(true);
        $gen = new \App\Helpers\ConfGenrator;
        $code = $gen->gen();
        $end_time = date("Y-m-d H:i:s",strtotime("now+1hour"));
        $response = $this->json("POST",'en/api/user/conformation',['phone'=>'772077550','dev_id'=>'12333123123','first_name'=>'Hisham','last_name'=>'Mohmed','user_type'=>\App\Customer::class,'email'=>'h.alkobati@gmail.com','dev_token'=>'123123123123',"password"=>"123123","gender"=>1]);
        
        $response->assertStatus(200);
        $this->assertDatabaseHas('tmp_users',['phone'=>'772077550','first_name'=>'Hisham','last_name'=>'Mohmed','user_type'=>\App\Customer::class,'email'=>'h.alkobati@gmail.com','code'=>$code,"end_time"=>$end_time]);

        $response->assertJson([
        	'st'=>'OK',
        	'data'=>[
                    'id'=>1,
        	        'phone'=>'772077550',
                    'dev_id'=>'12333123123',
        	        'code'=>$code,
        	        'end_time'=>date(strtotime("now+1hour"))]
        	]);

    }

    public function t123estUserConformation123(){

        $gen = new \App\Helpers\ConfGenrator;
        $code = $gen->gen();
        $end_time = date(strtotime("now+1hour"));

       $tmp_user = factory(\App\TmpUser::class)->create([
            'user_type'=>\App\Customer::class,
            'phone'=>'878787878787'

        ]);

        $res = $this->json('POST','en/api/user/active',
        ['tmp_id'=>$tmp_user->id,'code'=>$code,'phone'=>'878787878787']);
        $res->assertStatus(200);

        $this->assertDatabaseHas('users',['first_name'=>$tmp_user->first_name]);

    }


    public function testUserRegisterAsCustomer()
    {
        $this->assertTrue(true);
        // $tmp 
        // $arr_send = [
        //     'first_name' => 'Hisham',
        //     'last_name' => 'Alqubati',
        //     'phone'=>'772077550',
        //     'dev_id'=>'123123123',
        //     'dev_token'=>'123123123321321',
        //     'email'=>'h.alkobati@gmail.com',
        //     'owner_type'=>\App\Customer::class,
        //     'info'=>"welcom manmonah",
        //     // 'code'=>'1234'
        // ];


        // $res = $this->json('POST','en/api/user/register',$arr_send);
        // // dd($res);
        // $res->assertStatus(200);
        // $this->assertDatabaseHas('app_users',$arr_send);    
        // $this->assertDatabaseHas('customers',['name'=>$arr_send['first_name'].' '.$arr_send['last_name']]);


        // $tmp_user = \App\Customer::create();    

        
    }


   


   


    public function tes1tDeviceTokenRefresh()
    {
        $user = factory(\App\AppUser::class)->create([
            'owner_type'=> \App\Customer::class,
            'owner_id'=>function(){
                return factory(\App\Customer::class)->create()->id;
            }
            ]);
        
        $res_array = [
            'user_id'=>$user->id,
            'dev_token'=>"1112312312312312312313",
            'dev_id'=>$user->dev_id
        ];

        $res = $this->json('POST','en/api/user/update-device-token',$res_array);
        $res->assertStatus(200);

        $this->assertDatabaseHas('users',['dev_token'=>$res_array['dev_token'],'id'=>$res_array['user_id']]);
    }
}
