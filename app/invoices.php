<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class invoices extends Model
{
    protected $guarded=[];
    public function details()
    {
        return $this->hasMany(invoice_products ::class, 'invoice_id', 'id');
    }
 
  protected $dates =[
     'invoice_date',
  ];
}
