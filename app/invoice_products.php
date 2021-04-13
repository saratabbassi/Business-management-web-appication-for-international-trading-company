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
}
