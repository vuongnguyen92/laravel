<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class topic extends Model
{
    //
    protected $table = "topic";

    public function catagory(){
    	return $this->belongsTo('App\catagory','idCatagory','id');
    }

    public function tag(){
    	return $this->belongsToMany('App\tag','idTag','id');
    }

    public function comment(){
    	return $this->hasMany('App\comment','idTopic','id');
    }

    public function log(){
        return $this->hasMany('App\log','idTopic','id');
    }

    public function user(){
        return $this->belongsTo('App\user','idUser','id');
    }

}
