<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = ['name'];

    public function user(){
    	return $this->morphOne(\App\AppUser::class,'owner');
    }
}
