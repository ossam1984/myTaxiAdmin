<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpUser extends Model
{
    //
    protected $fillable = ['phone','dev_id','code','first_name','last_name','email','user_type','dev_token','end_time','gender'];
}
