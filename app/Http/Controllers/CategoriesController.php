<?php

namespace App\Http\Controllers;

use App\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = categories::all();
        return view('categories.categories',compact('categories'));

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
            'categorie_name' => 'required|unique:categories|max:255',
        ],[

            'categorie_name.required' =>'Veuillez saisir une categorie',
            'categorie_name.unique' =>' La categorie est déjà enregistré',


        ]);

            categories::create([
                'categorie_name' => $request->categorie_name,
            
                'created_by' => (Auth::user()->name),

            ]);
            session()->flash('Add', 'La catégorie a été ajoutée avec succès ');
            return redirect('/categories');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, categories $categories)
    {
        
        $id = $request->id;

        $this->validate($request, [

            'categorie_name' => 'required|max:255|unique:categories,categorie_name,'.$id,
           
        ],[

            'categorie_name.required' =>'Veuillez saisir une categorie',
            'categorie_name.unique' =>'La categorie est déjà enregistré',
           

        ]);

        $categories = categories::find($id);
        $categories->update([
            'categorie_name' => $request->categorie_name,
            'description' => $request->description,
        ]);

        session()->flash('edit','La catégorie a été modifiée avec succès');
        return redirect('/categories');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        categories::find($id)->delete();
        session()->flash('delete','La catégorie est supprimé avec succès');
        return redirect('/categories');
    }
}
