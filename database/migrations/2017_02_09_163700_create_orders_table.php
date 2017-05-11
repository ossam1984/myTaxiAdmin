<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_user_id');// id of "app_user", which should be id of user. Contact hisham
            $table->string('dev_id');// device id
            // $table->increments('id');
            $table->string('place_from_name');// name of location starting point
            $table->string('place_to_name');// name of location ending point
            $table->string('place_from_lat'); // lattitude of location starting point
            $table->string('place_from_lng');// lontitude of location starting point
            $table->string('place_to_lat'); // lattitude of location ending point
            $table->string('place_to_lng');// longtitude of location ending point
            $table->double('distance_m');// distance in meters, expressed in numbers
            $table->string('distance_k'); // distance in kilometers, expressed in string with ending of "km" or  "كم"
            $table->double('price_total');// total price of ride
            $table->integer('price_distance_k_first'); // number of initial kilometers, to be priced differently than subsequent kilometers
            $table->double('price_first'); // price of initial kilometers
            $table->longText('steps');// steps and directions expressed in different sentences
            $table->double('price_galon'); // price of single galon of gasoline
            $table->string('transportation_id'); // id of transportaion type
            $table->string('order_type_id'); // id of order type
            $table->string('st'); // status of the order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
