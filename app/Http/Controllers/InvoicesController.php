<?php

namespace App\Http\Controllers;
use App\devise;
use App\incoterm;
use App\invoices;
use App\customers;
use App\categories;
use App\sizes;
use App\products;
use App\Notifications\AddInvoice;
use Illuminate\Support\Facades\Notification;
use App\User;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $invoices= invoices::all();

        return view('invoices.invoices', compact('invoices'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    { 
        
      $invoices =invoices::all();
      if($invoices->isEmpty())
{
    $last = "Aucune facture disponible";
 }else{
    $last =invoices::pluck('invoice_no')->last();
 }       
    $devises = devise::all();
        $customers =customers::all();
        $categories=categories::all();
        $incoterms = incoterm::all();
      
       

       
        return view('invoices.add_invoices',compact('last','devises','customers','categories','incoterms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     
     */
   
    public function store(Request $request)

    {   
        $invoice_id = invoices::latest()->first()->id;
        $data['invoice_no'] = $request->invoice_no;
            
        $data['last_invoice_no'] = $request->last_invoice_no;
        $data['devise'] = $request->devise;
        $data['customer_name'] = $request->customer_name;
        $data['customer_adress'] = $request->customer_adress;
        $data['invoice_no'] = $request->invoice_no;
        $data['invoice_date'] = $request->invoice_date;
      
        $data['company_adress'] = $request->company_adress;
        $data['company_name'] = $request->company_name;
        $data['company_phone'] = $request->company_phone;
        $data['poids_brut'] = $request->poids_brut;
        $data['poids_net'] = $request->poids_net;
        $data['livraison'] = $request->livraison;
        $data['incoterm'] = $request->incoterm;
        $data['payment_details'] = $request->payment_details;
        $data['sub_total'] = $request->sub_total;
        $data['shipping'] = $request->shipping;
        $data['total_due'] = $request->total_due;
        $data['created_by'] = (Auth::user()->name);

        $invoices = Invoices::create($data);

        $details_list = [];
        for ($i = 0; $i < count($request->categorie_id); $i++) {
           
                                  
            $details_list[$i]['categorie_id'] = $request->categorie_id[$i];
            $details_list[$i]['product_id'] = $request->product_id[$i];
            $details_list[$i]['size_id'] = $request->size_id[$i];
            $details_list[$i]['quantity'] = $request->quantity[$i];
            $details_list[$i]['unit_price'] = $request->unit_price[$i];
            $details_list[$i]['total_price'] = $request->total_price[$i];
            $details_list[$i]['created_by'] = (Auth::user()->name);
       
                   }

        $details = $invoices->details()->createMany($details_list);
         $user = User::first();
           Notification::send($user, new AddInvoice($invoice_id));
        if ($details) {
            return redirect('/invoices')->with([
                'message' => __('la facture est créé avec succès'),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => __('la creation de facture a échoué'),
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
    public function edit($id)
    { 
      
   $invoices = invoices::where('id', $id)->first();   
        $devises = devise::all();
         $customers =customers::all();
         $categories=categories::all();
         $incoterms = incoterm::all();
         $incoterms = incoterm::all();
       
        
 
        
         return view('invoices.edit_invoice',compact('devises','customers','categories','invoices','incoterms'));
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
        $invoices = invoices::findOrFail($request->invoice_id);
    
        $data['invoice_no'] = $request->invoice_no;
        $data['last_invoice_no'] = $request->last_invoice_no;
        $data['devise'] = $request->devise;
        $data['customer_name'] = $request->customer_name;
        $data['customer_adress'] = $request->customer_adress;
        $data['invoice_no'] = $request->invoice_no;
        $data['invoice_date'] = $request->invoice_date;
        $data['company_adress'] = $request->company_adress;
        $data['company_name'] = $request->company_name;
        $data['company_phone'] = $request->company_phone;
        $data['poids_brut'] = $request->poids_brut;
        $data['poids_net'] = $request->poids_net;
        $data['livraison'] = $request->livraison;
        $data['incoterm'] = $request->incoterm;
        $data['payment_details'] = $request->payment_details;
        $data['sub_total'] = $request->sub_total;
        $data['shipping'] = $request->shipping;
        $data['total_due'] = $request->total_due;
        $data['created_by'] = (Auth::user()->name);

        $invoices->update($data);

        $invoices->details()->delete();

        $details_list = [];
        for ($i = 0; $i < count($request->categorie_id); $i++) {
           
            $details_list[$i]['categorie_id'] = $request->categorie_id[$i];
            $details_list[$i]['product_id'] = $request->product_id[$i];
            $details_list[$i]['size_id'] = $request->size_id[$i];
            $details_list[$i]['quantity'] = $request->quantity[$i];
            $details_list[$i]['unit_price'] = $request->unit_price[$i];
            $details_list[$i]['total_price'] = $request->total_price[$i];
            $details_list[$i]['created_by'] = (Auth::user()->name);
        }

        $details = $invoices->details()->createMany($details_list);

        if ($details) {
            return redirect()->back()->with([
                'message' => __('la facture est créé avec succès'),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => __('la creation de facture a échoué'),
                'alert-type' => 'danger'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        $id = $request->id;
       invoices::find($id)->delete();
        session()->flash('delete','La facture est supprimé avec succès');
        return redirect('/invoices');
    }
    
   
   public function getProducts($id)
    {
      
        $products = DB::table("products")->where("categorie_id", $id)->pluck("name", "id");
        return json_encode($products);
    }
    public function getDesignation($id)
    {
    
      $sizes = DB::table("sizes")->where("product_id", $id)->get();
        return json_encode($sizes);
    }
    public function Print_invoice_fr($id)
    {
        $invoices = invoices::where('id', $id)->first();
        return view('invoices.Print_invoice_fr',compact('invoices'));
    }
    public function Print_invoice_en($id)
    {
        $invoices = invoices::where('id', $id)->first();
        return view('invoices.Print_invoice_en',compact('invoices'));
    }
    public function Print_packing_fr($id)
    {
        $invoices = invoices::where('id', $id)->first();
        return view('invoices.Print_packing_fr',compact('invoices'));
    }
    public function Print_packing_en($id)
    {
        $invoices = invoices::where('id', $id)->first();
        return view('invoices.Print_packing-en',compact('invoices'));
    }
    
   
   

}
