<?php

namespace App\Http\Controllers;

use App\devise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devise = devise::all();
        return view('Devise.devise',compact('devise'));
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
        $validatedData = $request->validate([
            'devise' => 'required|unique:devises|max:3',
        ],[

            'devise.required' =>'Veuillez saisir une devise',
            'devise.unique' =>' La devise est déjà existante',
            'devise.max'=>'la devise doit contenir 3 lettres seulement'


        ]);

           Devise::create([
                'devise' => $request->devise,
                'created_by' => (Auth::user()->name),
            
              

            ]);
            session()->flash('Add', 'La devise a été ajoutée avec succès ');
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\devise  $devise
     * @return \Illuminate\Http\Response
     */
    public function show(devise $devise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\devise  $devise
     * @return \Illuminate\Http\Response
     */
    public function edit(devise $devise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\devise  $devise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [


            'devise' => 'required|max:3|unique:devises,devise,'.$id,
           
        ],[

            'devise.required' =>'Veuillez saisir une devise',
            'devise.unique' =>'La devise est déjà existante',
            'devise.max'=>'la devise doit contenir 3 lettres seulement'
           

        ]);

        $devise = Devise::find($id);
        $devise->update([
            'devise' => $request->devise,
                  ]);

        session()->flash('edit','La devise a été modifiée avec succès');
        return redirect('/devise');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\devise  $devise
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        $id = $request->id;
        Devise::find($id)->delete();
        session()->flash('delete','La devise est supprimé avec succès');
        return redirect('/devise');
    }
}
