<?php

namespace App\Http\Controllers;

use App\incoterm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncotermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incoterm = incoterm::all();
        return view('incoterm.incoterm',compact('incoterm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
            'incoterm' => 'required|unique:incoterms',
        ],[

            'incoterm.required' =>'Veuillez saisir un incoterm',
            'incoterm.unique' =>' L incoterm est déjà existant',
           


        ]);

           incoterm::create([
                'incoterm' => $request->incoterm,
                'created_by' => (Auth::user()->name),
            
              

            ]);
            session()->flash('Add', 'L incoterm a été ajoutée avec succès ');
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\incoterm  $incoterm
     * @return \Illuminate\Http\Response
     */
    public function show(incoterm $incoterm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\incoterm  $incoterm
     * @return \Illuminate\Http\Response
     */
    public function edit(incoterm $incoterm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\incoterm  $incoterm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, incoterm $incoterm)
    {
        $id = $request->id;

        $this->validate($request, [


            'incoterm' => 'required|max:3|unique:incoterm,incoterm,'.$id,
           
        ],[

            'incoterm.required' =>'Veuillez saisir un incoterm',
            'incoterm.unique' =>'L incoterm est déjà existante',
           
           

        ]);

        $incoterm = incoterm::find($id);
        $incoterm->update([
            'incoterm' => $request->incoterm,
                  ]);

        session()->flash('edit','L incoterm a été modifiée avec succès');
        return redirect('/incoterm');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\incoterm  $incoterm
     * @return \Illuminate\Http\Response
     */
    public function destroy(incoterm $incoterm)
    {
        $id = $request->id;
        incoterm::find($id)->delete();
        session()->flash('delete','L incoterm est supprimé avec succès');
        return redirect('/incoterm');
    }
}
