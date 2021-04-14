<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class devise extends Model
{
    protected $guarded=[];
    public function invoices(){
        return $this->hasMany('App\invoices');
    }
}
