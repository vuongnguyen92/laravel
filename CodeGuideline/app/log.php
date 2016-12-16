<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class log extends Model
{
    //
    protected $table = "log";

    public function topic(){
    	return $this->belongsTo('App\topic','idTopic','id');
    }
}