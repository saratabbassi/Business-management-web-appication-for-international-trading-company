<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\products_attachement;
use Illuminate\Http\Request;

class ProductsAttachementController extends Controller
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
        $this->validate($request, [

            'file_name' => 'mimes:pdf,jpeg,png,jpg',
    
            ], [
                'file_name.mimes' => ' l image doit etre en format pdf, jpeg , png , jpg',
            ]);
            
            $image = $request->file('file_name');
            $file_name = $image->getClientOriginalName();
    
            $attachements =  new products_attachement();
            $attachements->file_name = $file_name;
           
            $attachements->product_id = $request->product_id;
            $attachements->Created_by = Auth::user()->name;
            $attachements->save();
               
            // move pic
            $imageName = $request->file_name->getClientOriginalName();
          
            $request->file_name->move(public_path('Attachments/' . $request->product_name), $imageName);
            
            session()->flash('Add', 'Image Ajouté avec succées');
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\products_attachement  $products_attachement
     * @return \Illuminate\Http\Response
     */
    public function show(products_attachement $products_attachement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\products_attachement  $products_attachement
     * @return \Illuminate\Http\Response
     */
    public function edit(products_attachement $products_attachement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\products_attachement  $products_attachement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, products_attachement $products_attachement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\products_attachement  $products_attachement
     * @return \Illuminate\Http\Response
     */
    public function destroy(products_attachement $products_attachement)
    {
        //
    }
}
