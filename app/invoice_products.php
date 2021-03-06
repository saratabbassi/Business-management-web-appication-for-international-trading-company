<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice_products extends Model
{
    protected $guarded=[];

    public function invoice()
    {
        return $this->belongsTo(Invoices::class, 'invoice_id', 'id');
    }
    
 public function product()
 {
 return $this->belongsTo('App\products');
 }
 public function size()
 {
 return $this->belongsTo('App\sizes');
 }
 public function categorie()
 {
 return $this->belongsTo('App\categories');
 }
}
