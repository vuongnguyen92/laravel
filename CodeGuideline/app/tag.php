<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    //
    protected $table = "tag";

    public function topic(){
    	return $this->belongsToMany('App\topic')->withTimestamps();
    }
}
