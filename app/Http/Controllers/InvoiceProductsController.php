<?php

namespace App\Http\Controllers;

use App\invoice_products;
use Illuminate\Http\Request;

class InvoiceProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        foreach ($request->moreFields as $key => $value) {

            invoice_products::create([
                 'invoice_id' => $invoice_id,
                 'designation'=>$value['designation'],
                 'buying_price'=>$value['buying_price'],
                 'selling_price'=>$value['selling_price'],
                 'stock'=>$value['stock'],
                 'weight'=>$value['weight'],
             ]);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invoice_products  $invoice_products
     * @return \Illuminate\Http\Response
     */
    public function show(invoice_products $invoice_products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoice_products  $invoice_products
     * @return \Illuminate\Http\Response
     */
    public function edit(invoice_products $invoice_products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoice_products  $invoice_products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoice_products $invoice_products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoice_products  $invoice_products
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoice_products $invoice_products)
    {
        //
    }
}
