<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $fillable =[
        'categorie_name',
        'created_by'
    ];
    public function products(){
        return $this->hasMany('App\products');
    }
}
