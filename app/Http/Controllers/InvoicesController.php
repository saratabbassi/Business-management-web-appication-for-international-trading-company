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
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;

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
        $validatedData = $request->validate([
            'invoice_no' => 'required|unique:invoices',
            'devise' =>'required',
            'customer_name' => 'required',
            'customer_adress' =>'required',
            'invoice_date' => 'required',
            'company_adress' =>'required',
            'company_name' =>'required',
            'company_phone' =>'required',
            'poids_brut'=>'required',
            'poids_net'=>'required',
            'incoterm'=>'required',
            'payment_details'=>'required',
            'sub_total'=>'required',
            'total_due'=>'required',

           


        ],[
            'invoice_no.unique'=>'Le numero de facture a déjà été pris',
            'invoice_no.required' => 'Saisir le numero de facture',
            'devise.required' => 'Choisir un devise',
            'customer_name.required' => 'Choisir un Client',
            'customer_name.required' => 'Le champ adresse du client est obligatoire',
            'company_name.required'=>'Le champ Nom Societé est obligatoire',
            'company_adress.required'=>'Le champ Adresse societé est obligatoire',
            'company_phone.required'=>'Le champ Tel est obligatoire',
            'poids_brut.required'=>'Le champ Poids brut est obligatoire',
            'poids_net.required'=>'Le champ Poids net est obligatoire',
            'payment_details.required'=>'Le champ Détails de paiement est obligatoire',
            'sub_total.required'=>'Le champ Sub Total est obligatoire',
            'total_due.required'=>'Le champ Total due  est obligatoire',
            'incoterm.required' => 'Choisir un Incoterm',
            ]);
        $data['invoice_no'] = $request->invoice_no;
            
        $data['last_invoice_no'] = $request->last_invoice_no;
        $data['devise'] = $request->devise;
        $data['customer_name'] = $request->customer_name;
        $data['customer_adress'] = $request->customer_adress;
     
        $data['invoice_date'] = $request->invoice_date;
      
        $data['company_adress'] = $request->company_adress;
        $data['company_name'] = $request->company_name;
        $data['company_phone'] = $request->company_phone;
        $data['poids_brut'] = $request->poids_brut;
        $data['poids_net'] = $request->poids_net;
        $data['poids_emballage'] = $request->poids_emballage;
        $data['livraison'] = $request->livraison;
        $data['packages'] = $request->packages;
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
            $details_list[$i]['weight'] = $request->weight[$i];
            $details_list[$i]['total_weight'] = $request->total_weight[$i];
            $details_list[$i]['total_price'] = $request->total_price[$i];
            $details_list[$i]['created_by'] = (Auth::user()->name);
       
                   }

        $details = $invoices->details()->createMany($details_list);
        $invoice_id = invoices::latest()->first()->id;
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
        return view('invoices.Print_packing_en',compact('invoices'));
    }
    public function Print_proforma_en($id)
    {
        $invoices = invoices::where('id', $id)->first();
        return view('invoices.Print_proforma_en',compact('invoices'));
    }
    public function Print_proforma_fr($id)
    {
        $invoices = invoices::where('id', $id)->first();
        return view('invoices.Print_proforma_fr',compact('invoices'));
    }
    
    public function export() 
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }
   

}
