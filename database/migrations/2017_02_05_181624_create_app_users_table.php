<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_users', function (Blueprint $table) {// this is a negelected table that is not used in this project
            $table->increments('id');
            $table->morphs("owner");
            // $table->string("activ_code")->nullabe();
            $table->string("phone");
            $table->string("first_name");
            $table->string("last_name");
            $table->string("email")->nullable();
            $table->longText("info")->nullable();
            $table->string("dev_id");
            $table->longText("dev_token");
            $table->timestamps();
            // $table->index(["owner_id","owner_type"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_users');
    }
}
