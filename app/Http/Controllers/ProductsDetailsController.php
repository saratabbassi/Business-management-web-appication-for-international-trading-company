<?php

namespace App\Http\Controllers;
use App\products;
use App\sizes;
use App\products_details;
use App\products_attachement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductsDetailsController extends Controller
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
     * 
     *  a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\products_details  $products_details
     * @return \Illuminate\Http\Response
     */
    public function show(products_details $products_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\products_details  $products_details
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $products = products::where("id",$id)->first();
        $details = products_details::where('id_product',$id)->get();
        $attachements = products_attachement::where('product_id',$id)->get();
        $sizes = sizes::where('product_id',$id)->get();
        return view('products.productDetails',compact('products','details','attachements','sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\products_details  $products_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, products_details $products_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\products_details  $products_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        $products = products_attachement::findOrFail($request->id_file);
        $products->delete();
        Storage::disk('public_uploads')->delete($request->product_id.'/'.$request->file_name);
        session()->flash('delete', 'L image est supprimer avec succés');
        return back();
    }
    public function open_file($name,$file_name)

    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($name.'/'.$file_name);
        return response()->file($files);
    }
    public function get_file($name,$file_name)

    {
        $contents= Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($name.'/'.$file_name);
        return response()->download( $contents);
    }
}
