<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
class OrderCtrl extends Controller
{
    //


    /**
     * Get an order by id
     *
     * Undocumented function long description
     *
     * @param type var Description
     **/
    public function getOrderById(Request $req)
    {
        $id = $req->get("id");
        $order = \App\Order::find($id);
        return $order;
    }
    /**
     * Customer can make an order 
     *
     * @return API (JSON DATA)
     * @author Hisham Ahmed Nasher 
     **/
    public function makeNewOrder(Requests\OrderRequest $req)
    {
    	// get Order data
    	$order = $req->get('order');
        // Customer info
        // $customer_id = $req->get('user_id');
        // $dev_id = $req->get('dev_id');


        // Make New Order 

        $order = new \App\Order();

        $order->app_user_id = $req->get("app_user_id") ;
        $order->dev_id = $req->get("dev_id") ;
        $order->place_from_name = $req->get("place_from_name") ;
        $order->place_to_name = $req->get("place_to_name") ;
        $order->place_from_lat = $req->get("place_from_lat") ;
        $order->place_from_lng = $req->get("place_from_lng") ;
        $order->place_to_lat = $req->get("place_to_lat") ;
        $order->place_to_lng = $req->get("place_to_lng") ;
        $order->distance_m = $req->get("distance_m") ;
        $order->distance_k = $req->get("distance_k") ;
        $order->price_total = $req->get("price_total") ;
        $order->price_distance_k_first = $req->get("price_distance_k_first") ;
        $order->price_first = $req->get("price_first") ;
        $order->steps = $req->get("steps") ;
        $order->price_galon = $req->get("price_galon") ;
        $order->transportation_id = $req->get("transportation_id") ;
        $order->order_type_id = $req->get("order_type_id") ;
        $order->st = "Created" ;

        $order->save();
        return $order;   
    }
    /**
     * Change Status Of order 
     *
     * send for this functions request parmiters to change states when user delete an order or complate changeOrderSt
     *
     * @param type var Description
     **/
    public function changeOrderSt(Request $req)
    {
        $order = \App\Order::whereId($req->get("id"))
        ->whereDevId($req->get("dev_id"))
        ->whereAppUserId($req->get("app_user_id"))
        ->update(["st"=>$req->get("st")]);

        if($order){
            return ["st"=>"OK","data"=>$order];

        }
        else{
            return ["st"=>"error","data"=>[]];
        }
    }


    /**
     * Get All orders that near of Drivers
     *
     * This function olny use in Driver App
     *
     * @param type var Description
     **/
    public function nearOrders()
    {
        return \Request::get("ids");
    }       
    

    /**
     * Api To Accept Near nearOrders
     *
     * Function to make acception for an order 
     *
     * @param type var Description
     **/
    public function acceptOrder(Request $request)
    {

       
     $data = ["type"=>"order_accept",
        "data"=>[
            "driver"=>[
                "name"=>"محمد محسن شبيبة",
                "phone"=>"7735546788",
                "img"=>"https://msdnshared.blob.core.windows.net/media/MSDNBlogsFS/prod.evol.blogs.msdn.com/CommunityServer.Blogs.Components.WeblogFiles/00/00/00/98/83/1881.RobSinclair1_2013.jpg"
            ],
            ]
        ];
    return $data;
    // $push = new \App\Helpers\PushNote();
    // return $push->send("Your order accept","Your order number 123 accept",["fI68ls9UUHA:APA91bFjH0AARfwWSC_6ZGxrb-sERWeZxWS9Jt2dD4XXt7Rd8kMJ0p9_KENldg4SVWg9Xgvjg31IWkOwno0FJkfA2dpCR_7M2vtqsfi_iXCAeNyaoCLOLthiB6zfa4rrfYwJhsIL1I3A"],$data);

    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param type var Description
     **/
    public function sendOrderRequestToNearDrivers()
    {
        # code...
    }


    /**
     * Get near orders
     *
     * Get All Near orders by user driver 
     *
     * @param ids Array     
     **/
    public function getNearOrders(Request $request)
    {
        $order_ids = $request->get("ids");
        $orders = \App\Order::with("customer")->whereIn("id",$order_ids)->get();
        return $orders;
    }


    
}
