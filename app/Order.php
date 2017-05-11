<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ["app_user_id","dev_id","place_from_name","place_to_name","place_from_lat","place_from_lng","place_to_lat","distance_m","price_total","price_distance_k_first","price_first","steps","price_galon","transportation_id","order_type_id","st"];

    public function customer(){
        return $this->belongsTo(\App\User::class,"app_user_id");
    }
}
