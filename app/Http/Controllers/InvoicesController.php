<?php

namespace App\Http\Controllers;
use App\devise;
use App\invoices;
use App\customers;
use App\categories;
use App\sizes;
use App\products;

use Illuminate\Http\Request;
use DB;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $invoices= Products::all();

        return view('invoices.invoices', compact('invoices'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    { 
        
      
            
        $last = !invoices::latest() ? invoices::latest()->first()->invoice_no: "Aucune facture disponible" ;
        $devises = devise::all();
        $customers=customers::all();
        $categories=categories::all();
      
       

       
        return view('invoices.add_invoices',compact('last','devises','customers','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     
     */
   
    public function store(Request $request)

    {   
        
        $data['invoice_no'] = $request->invoice_no;
        $data['devise'] = $request->devise;
        $data['customer_name'] = $request->customer_name;
        $data['customer_adress'] = $request->customer_adress;
        $data['invoice_number'] = $request->invoice_number;
        $data['invoice_date'] = $request->invoice_date;
        $data['company_adress'] = $request->company_adress;
        $data['company_phone'] = $request->company_phone;
        $data['poids_brut'] = $request->poids_brut;
        $data['poids_net'] = $request->poids_net;
        $data['livraison'] = $request->livraison;
        $data['incoterm'] = $request->incoterm;
        $data['payment_details'] = $request->payment_details;
        $data['sub_total'] = $request->sub_total;
        $data['shipping'] = $request->shipping;
        $data['total_due'] = $request->total_due;

        $invoice = Invoice::create($data);

        $details_list = [];
        for ($i = 0; $i < count($request->categorie_id); $i++) {
            $details_list[$i]['categorie_id'] = $request->categorie_id[$i];
            $details_list[$i]['product_id'] = $request->product_id[$i];
            $details_list[$i]['size_id'] = $request->size_id[$i];
            $details_list[$i]['quantity'] = $request->quantity[$i];
            $details_list[$i]['unit_price'] = $request->unit_price[$i];
            $details_list[$i]['row_sub_total'] = $request->row_sub_total[$i];
        }

        $details = $invoice->details()->createMany($details_list);

        if ($details) {
            return redirect()->back()->with([
                'message' => __('Frontend/frontend.created_successfully'),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => __('Frontend/frontend.created_failed'),
                'alert-type' => 'danger'
            ]);
        }
       

       }
    /**
     * Display the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response 
     */
    public function show(invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices $invoices)
    {
        //
    }
    public function getProducts($id)
    {
        $products = DB::table("products")->where("categorie_id", $id)->pluck("name", "id","user");
        return json_encode($products);
    }
    public function getDesignation($id)
    {
        $sizes = DB::table("sizes")->where("product_id", $id)->pluck("designation", "selling_price" ,"id");
        return json_encode($sizes);
    }
  
   

}
