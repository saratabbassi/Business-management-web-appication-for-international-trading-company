<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use NumberToWords\NumberToWords;

class invoices extends Model
{
    protected $guarded=[];
    public function details()
    {
        return $this->hasMany(invoice_products::class, 'invoice_id', 'id');
    }
 
  protected $dates =[
     'invoice_date',
  ];
  public function getInvoiceDateAttribute($value)
  {
    return Carbon::parse($value)->format('d-m-Y'); 
  }
  public function devises(){
    return $this->belongsTo('App\devise'); 
  }
  public function customers()
 {
 return $this->belongsTo('App\customers');
 }

}
