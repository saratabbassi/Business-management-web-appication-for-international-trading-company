<?php

namespace App\Http\Controllers;
use App\devise;
use App\incoterm;
use App\invoices;
use App\customers;
use App\categories;
use App\sizes;
use App\invoices_details;
use App\products;
use App\Notifications\AddInvoice;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\Add_invoice;

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
            'customer_adress.required' => 'Le champ adresse du client est obligatoire',
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
        $data['Status'] = 'Non Payé';
        $data['Value_Status'] = 2;
        $data['paid_amount'] = 0;
        
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
        $data['total_ben'] = $request->total_ben;
        $data['created_by'] = (Auth::user()->name);

        $invoices = Invoices::create($data);
        
        
        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            'id_Invoice' => $invoice_id,
            'invoice_number' => $request->invoice_no,
            'total_due' => $request->total_due,
            'Status' => 'Non Payé',
            'Value_Status' => 2,
            'paid_amount' => 0,
          
            'user' => (Auth::user()->name),
        ]);

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
            $details_list[$i]['buying_price'] = $request->buying_price[$i];
            $details_list[$i]['benefice'] = $request->benefice[$i];
            $details_list[$i]['created_by'] = (Auth::user()->name);
       
                   }

        $details = $invoices->details()->createMany($details_list);
        $invoice_id = invoices::latest()->first()->id;
           
        
  
         //$user = User::first();
          // Notification::send($user, new AddInvoice($invoice_id));
           
           $user = User::get();
        $invoices = invoices::latest()->first();
        Notification::send($user, new Add_invoice($invoices));
       
       
      //  
        //return redirect('/invoices');
        if ($details) {
            return redirect('/invoices')->with([
                session()->flash('Add', 'la facture est créé avec succès')
            ]);
        } else {
            return redirect()->back()->with([
                'message' => __('la modification de facture a échoué'),
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
    public function show($id)
    {
        $invoice = invoices::where('id', $id)->first();
        return view('invoices.status_update', compact('invoice'));
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
        $id = $request->invoice_id;
    

        $this->validate($request, [

            'invoice_no' => 'required|unique:invoices,invoice_no,'.$id,
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
            'customer_adress.required' => 'Le champ adresse du client est obligatoire',
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

        $invoices = invoices::findOrFail($request->invoice_id);

        $data['invoice_no'] = $request->invoice_no;
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
  
        $invoices->update($data);

        $invoices->details()->delete();

        $details_list = [];
        for ($i = 0; $i < count($request->categorie_id); $i++) {
           
            $details_list[$i]['categorie_id'] = $request->categorie_id[$i];
            $details_list[$i]['product_id'] = $request->product_id[$i];
            $details_list[$i]['size_id'] = $request->size_id[$i];
            $details_list[$i]['quantity'] = $request->quantity[$i];
            $details_list[$i]['weight'] = $request->weight[$i];
            $details_list[$i]['total_weight'] = $request->total_weight[$i];
            $details_list[$i]['unit_price'] = $request->unit_price[$i];
            $details_list[$i]['buying_price'] = $request->buying_price[$i];
            $details_list[$i]['total_price'] = $request->total_price[$i];
            $details_list[$i]['benefice'] = $request->benefice[$i];
            $details_list[$i]['created_by'] = (Auth::user()->name);
        }

        $details = $invoices->details()->createMany($details_list);

        session()->flash('edit', 'La facture est modifié');
        return redirect('/invoices');
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
   
    public function Status_Update($id, Request $request)    
    {
        $invoices = invoices::findOrFail($id);

        if ($request->Status === 'Totalement payé') {

            $invoices->update([
                'Value_Status' => 1,
                'Status' => $request->Status,
                //'Payment_Date' => $request->Payment_Date,
            ]);

            invoices_Details::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_no,
                'Status' => $request->Status,
                'paid_amount'=>$request->paid_amount,
                'total_due'=>$request->total_due,
                'Value_Status' => 1,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }

        else {
            $invoices->update([
                'Value_Status' => 3,
                'Status' => $request->Status,
                
             
            ]);
            invoices_Details::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_no,
                'Status' => $request->Status,
                'paid_amount'=>$request->paid_amount,
                'total_due'=>$request->total_due,
                'Value_Status' => 3,
               'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }
        session()->flash('Status_Update');
        return redirect('/invoices');

    }
     public function Invoice_Paid()
    {
        $invoices = Invoices::where('Value_Status', 1)->get();
        return view('invoices.invoices_paid',compact('invoices'));
    }

    public function Invoice_unPaid()
    {
        $invoices = Invoices::where('Value_Status',2)->get();
        return view('invoices.invoices_unpaid',compact('invoices'));
    }

    public function Invoice_Partial()
    {
        $invoices = Invoices::where('Value_Status',3)->get();
        return view('invoices.invoices_Partial',compact('invoices'));
    }
    public function MarkAsRead_all (Request $request)
    {

        $userUnreadNotification= auth()->user()->unreadNotifications;

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
            
        }


    }
    
    public function ReadNotification($id)
    {
      $userUnreadNotification = auth()->user()
                                      ->unreadNotifications
                                      ->where('id', $id)
                                      ->first();
        
      if($userUnreadNotification) {
        $userUnreadNotification->markAsRead();
      }
      return redirect('/invoices') ;
    }
    

    public function unreadNotifications_count()

    {
        return auth()->user()->unreadNotifications->count();
    }

    public function unreadNotifications()

    {
        foreach (auth()->user()->unreadNotifications as $notification){

return $notification->data['title'];

        }

    }

}
