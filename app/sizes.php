<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sizes extends Model
{
  protected $fillable = [
    'product_id',
    'designation',
    'selling_price',
    'buying_price',
    'stock',
    'weight',
];
      public function products(){
        return $this->belongsTo('App\products'); 
      }
}
