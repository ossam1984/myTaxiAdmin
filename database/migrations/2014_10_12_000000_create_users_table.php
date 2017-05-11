<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->morphs("owner"); // for the polimorphic columns owner_id and owner_type,  that link to either the driver or the customer.

            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->integer('gender');
            $table->string('dev_id')->nullable(); //device id
            $table->string('dev_token')->nullable(); //device token
            $table->string('phone');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
