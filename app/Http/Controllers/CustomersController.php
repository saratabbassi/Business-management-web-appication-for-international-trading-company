<?php

namespace App\Http\Controllers;

use App\customers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers= customers::all();
        return view('customers.customers',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.add_customers');
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
            'customer_name' => 'required|unique:customers',
            'customer_email' => 'nullable|unique:customers|email' ,
            'customer_phone' =>  'nullable|unique:customers',
            'customer_adress' =>  'required',
        ],[
            
            'customer_name.required' =>'Veuillez saisir le nom du client',
            'customer_name.unique' =>'le client existe déja',
            'customer_email.email' =>'le client existe déja',
            'customer_email.unique' =>'Adresse mail déja utilisé ',
            'customer_phone.unique' =>'Le téléphone du client a déjà été pris.',
            'customer_adress.required' =>'Veuillez saisir l adresse du client',
            
            

            ]);
            customers::create([
                'customer_name' => $request->customer_name,
                
                'customer_email' => $request->customer_email,
                
                'customer_phone' => $request->customer_phone,
                'customer_adress' => $request->customer_adress,
                'matricule' => $request->matricule,
                'fax' => $request->fax,
                'home_phone' => $request->home_phone,
                
            
                'created_by' => (Auth::user()->name),

            ]);
            session()->flash('Add', 'Le client a été ajoutée avec succès ');
            return redirect('/customers');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function show(customers $customers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = customers::where('id', $id)->first();
       
        return view('customers.edit_customer', compact('customers'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customers $customers)
    {
        $customers = customers::findOrFail($request->customer_id);
        $validatedData = $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'nullable|email|unique:customers,customer_email,' . $request->customer_id,
            'customer_phone' =>  'nullable',
            'customer_adress' =>  'required',
        ],[
            
            'customer_name.required' =>'Veuillez saisir le nom du client',
            'customer_name.unique' =>'le client existe déja',
            'customer_email.email' =>'le client existe déja',
            'customer_email.unique' =>'Adresse mail déja utilisé ',
            'customer_phone.unique' =>'Le téléphone du client a déjà été pris.',
            'customer_adress.required' =>'Veuillez saisir l adresse du client',
            
            

            ]);
        $customers->update([
 
            
            'customer_name' => $request->customer_name,
                
                'customer_email' => $request->customer_email,
                
                'customer_phone' => $request->customer_phone,
                'customer_adress' => $request->customer_adress,
            
        ]);

        session()->flash('edit', 'Le client est modifié');
        return redirect('/customers');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        $id = $request->id;
       customers::find($id)->delete();
        session()->flash('delete','Le client est supprimé avec succès');
        return redirect('/customers');
    }
}
