<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    //
    protected $fillable = ['name','driver_licence_no'];
    protected $table = "drivers";


    public function user(){
    	return $this->morphOne(\App\User::class,'owner');
    }
}
