<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
   
    protected $guarded=[];
      public function categorie(){
        return $this->belongsTo('App\categories'); 
      }
      public function sizes(){
        return $this->hasMany('App\sizes');
    }
}
