<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    //
    protected $table = "comment";

    public function topic(){
    	return $this->belongsTo('App\topic','idTopic','id');
    }

    public function user(){
    	return $this->belongsTo('App\User','idUser','id');
    }
}
