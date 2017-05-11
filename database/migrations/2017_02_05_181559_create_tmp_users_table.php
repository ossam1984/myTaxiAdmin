<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmpUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_users', function (Blueprint $table) {// temporary users table to store registered user info before acrivation by admin
            $table->increments('id');
            $table->string('dev_id');
            $table->string('phone');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('user_type'); // polimorphic relationship to know what type of user is this
            $table->string('code')->nullable(); // registeration code
            $table->timestamp('end_time');// temporary registeration end-date, 
            $table->string('dev_token'); // device token
            $table->integer('gender')->default(1);
            // $table->timestamp("ended_on");
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
        Schema::dropIfExists('tmp_users');
    }
}
