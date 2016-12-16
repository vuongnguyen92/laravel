<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class catagory extends Model
{
    //
    protected $table = "catagory";

    public function topic(){
   		return $this->hasMany('App\topic','idCatagory','id');
    }
}
