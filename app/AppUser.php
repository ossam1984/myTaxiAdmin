<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    //

    protected $fillable = ['owner_type','owner_id','info','first_name','last_name','email','phone','dev_id','dev_token'];


    public function owner(){
    	return $this->morphTo();
    }
}
