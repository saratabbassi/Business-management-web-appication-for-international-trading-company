<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\categories;
use App\devise;
use App\invoices;
use App\customers;

use App\sizes;
use App\products;

class InvoiceProducts extends Component
{
    public $invoiceProducts = [];
    public $categories = [];
    public $devises = [];
    public $customers = [];
 
    public $updateMode = false;

    public $i = 1;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->invoiceProducts ,$i);
    }
     
    public function mount()
    {
      $this->devises = devise::all();
      $this->customers = customers::all();
        $this->categories = Categories::all();
        $this->invoiceProducts = [
            ['categorie_id' => '', 'product_id' => '','size_id' => '','quantity' => 1,'unit_price' => '','total_price' => '']
        ];
        
    }
    public function addProduct()
    {
        $this->invoiceProducts[] =  ['categorie_id' => '', 'product_id' => '','size_id' => '','quantity' => 1,'unit_price' => '','total_price' => ''];
    }
    
    public function removeProduct($index)
    {
        unset($this->invoiceProducts[$index]);
        $this->invoiceProducts = array_values($this->invoiceProducts);
    }
    public function render()
    {
        
        return view('livewire.invoice-products');
    }
}
