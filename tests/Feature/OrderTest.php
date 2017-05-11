<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{

	use DatabaseMigrations;
	// private $order_types
    /**
     * A basic test example.
     *
     * @return void
     */


    public function testExample()
    {
        $this->assertTrue(true);
    }



    public function testCustomerCanAddAnOrder()
    {
    	// Add Customer
    	$customer = factory(\App\AppUser::class)->create([
    		'owner_type'=>\App\Customer::class,
    		'owner_id'=>function(){
    			return factory(\App\Customer::class)->create()->id;
    		}
    		]);
		// السلام عليم ظ
    	// Order Type
    	$order_type = factory(\App\OrderType::class)->create();


    	// transportation
    	$transportation = factory(\App\Transportation::class)->create();


    	// User Make Order
    	$data=[
    		'user_id'=>$customer->id,
    		'dev_id'=>$customer->dev_id,
    		// 'dev_id'=>$customer->dev_id,
    		'order'=>[
    			'app_user_id' => $customer->id,
    			'place_from_name' => 'Place From Name',
    			'place_to_name' => 'Place Last Name',


    			'place_from_lat' => '12.88899999',
    			'place_from_lng' => '14.98989999',


    			'place_to_lat' => '17.99888999',
    			'place_to_lng' => '19.9898999',
    			

    			'distance_m' => 1233.2,
    			'distance_k' => '5 كيلومتر',

				"dev_id" => $customer->dev_id,

    			'price_total' => "1320.0",
    			'price_distance_k_first' => 2,
    			'price_first' => "300.0",
    			'price_galon'=>5500,
				

    			'transportation_id'=>$transportation->id,
    			
    			'order_type_id'=>$order_type->id,

    			'steps' => 'all steps here',
    			'st' => 'Created'


    		]
    	];
		// dd($data["order"]);
    	$res = $this->json('POST','en/api/orders/new',$data["order"]);
    	$res->assertStatus(200);
		// $this->json('POST')
    	// $this->assertDatabaseHas('orders',["dev_id"=>$data["order"]["dev_id"]]);
    	$this->assertDatabaseHas('orders',$data["order"]);
		$res->assertJson(
			$data["order"]
		);
    }


	public function testChangeOrderState(){
		$order = factory(\App\Order::class)->create([
			"app_user_id"=>1,
			"dev_id"=>123454321123,
			
		]);
		$data =[
			"id"=>$order->id,
			"app_user_id"=>$order->app_user_id,
			"dev_id"=>$order->dev_id,
			"st"=>"Canceled"

		];

		$res = $this->json("POST","en/api/orders/change",$data);
		$res->assertStatus(200);
		$this->assertDatabaseHas("orders",$data);
	}
}
