<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class invoices_details extends Model
{
    protected $guarded=[];
    protected $dates =[
        'Payment_Date',
     ];
     public function getPaymentDateAttribute($value)
     {
       return Carbon::parse($value)->format('d-m-Y'); 
     }
}
