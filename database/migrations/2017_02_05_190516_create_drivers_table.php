<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {// a driver is always linked to a user
            $table->increments('id');
            $table->string('name');
            $table->string('dev_id')->nullable();// device id
            $table->string('driver_licence_no')->nullable(); // driver licence number
            
            
            $table->string('image')->nullable();// image path
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
        Schema::dropIfExists('drivers');
    }
}
