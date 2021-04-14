<?php

namespace App\Http\Controllers;

use App\products;
use Illuminate\Http\Request;
use App\categories;
use App\sizes;
use App\products_details;
use App\products_attachement;
use Validator,Redirect,Response;

use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= Products::all();

        return view('products.products', compact('products'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
       $categories = Categories::all();
       return view('products.addproduct', compact('categories'));
       
       
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
            'name' => 'required|unique:products',
         
         
      
         
                'moreFields.*.designation' => 'required',
                'moreFields.*.buying_price' => 'required|numeric|min:0',
                'moreFields.*.selling_price' => 'required|numeric|min:0',
                'moreFields.*.weight' => 'required|numeric|min:0',
                'moreFields.*.stock' => 'required|min:0|integer',
        
         
            'file_name' => 'mimes:pdf,jpeg,png,jpg',
            'categorie_id'=>'required'
        ],[

            'name.required' =>'Veuillez saisir le nom du produit',
            'name.unique' =>' Le produit existe deja',
       
          'moreFields.*.designation.required' => "Veuillez saisir la designation",
          'moreFields.*.buying_price.required' =>"Veuillez saisir le prix d achat",
          'moreFields.*.selling_price.required'=>"Veuillez saisir le prix de vente",
          'moreFields.*.weight.required'=>"Veuillez saisir le pois",
          'moreFields.*.stock.required'=>"Veuillez saisir le stock",
          'moreFields.*.buying_price.numeric'=>'le prix d achat doit entre un nombre ',
          'moreFields.*.buying_price.min'=>'le prix d achat doit etre un nombre positive',
          'moreFields.*.selling_price.numeric'=>'le prix de vente doit entre un nombre ',
          'moreFields.*.selling_price.min'=>'le prix de vente doit etre un nombre positive',
          'moreFields.*.weight.numeric'=>'le poids doit entre un nombre ',
          'moreFields.*.weight.min'=>'le poids doit entre un nombre positive',
           
          'moreFields.*.stock.min'=>'
          La quantité doit être un entier positive',
          'moreFields.*.stock.integer'=>'
          La quantité doit être un entier.',

            'file_name.mimes' => ' l image doit etre en format pdf, jpeg , png , jpg',
            'categorie_id.required' =>'Veuillez choisir une categorie',
            


        ]);
        products::create([
            'name' => $request->name,
            
            
            
            'categorie_id' => $request->categorie_id,
           
            'description' => $request->description,
            'user' => (Auth::user()->name),
           
            
        ]);
        $product_id = products::latest()->first()->id;
        products_details::create([
            'id_product' => $product_id,
            'name' => $request->name,
            
            'categorie' => $request->categorie_id,
         
          
            'user' => (Auth::user()->name),
          
        ]);
  
   
        foreach ($request->moreFields as $key => $value) {

           sizes::create([
                'product_id' => $product_id,
                'designation'=>$value['designation'],
                'buying_price'=>$value['buying_price'],
                'selling_price'=>$value['selling_price'],
                'stock'=>$value['stock'],
                'weight'=>$value['weight'],
            ]);
        }
     
        if ($request->hasFile('pic')) {
         
         

            $product_id = products::latest()->first()->id;
          
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $name = $request->name;

            $attachments = new products_attachement();
            $attachments->file_name = $file_name;
           // $attachments->name = $name;
            $attachments->Created_by = Auth::user()->name;
            $attachments->product_id = $product_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $name), $imageName);
        }
        return view('products.products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = products::where('id', $id)->first();
        $categories = categories::all();
        $sizes = sizes::where('product_id',$id)->get();
        
        
        return view('products.edit_product', compact('categories', 'products','sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, products $products,sizes $sizes ,$id)
    
    {
        $products = products::findOrFail($request->product_id);
    
    //     $validatedData = $request->validate([
    //         'name' => 'required|unique:products',
         
         
      
         
    //         'moreFields.*.designation' => 'required',
    //         'moreFields.*.buying_price' => 'required|numeric|min:0',
    //         'moreFields.*.selling_price' => 'required|numeric|min:0',
    //         'moreFields.*.weight' => 'required|numeric|min:0',
    //         'moreFields.*.stock' => 'required|min:0|integer',
    
     
    //     'file_name' => 'mimes:pdf,jpeg,png,jpg',
    //     'categorie_id'=>'required'
    // ],[

    //     'name.required' =>'Veuillez saisir le nom du produit',
    //     'name.unique' =>' Le produit existe deja',
   
    //   'moreFields.*.designation.required' => "Veuillez saisir la designation",
    //   'moreFields.*.buying_price.required' =>"Veuillez saisir le prix d achat",
    //   'moreFields.*.selling_price.required'=>"Veuillez saisir le prix de vente",
    //   'moreFields.*.weight.required'=>"Veuillez saisir le pois",
    //   'moreFields.*.stock.required'=>"Veuillez saisir le stock",
    //   'moreFields.*.buying_price.numeric'=>'le prix d achat doit entre un nombre ',
    //   'moreFields.*.buying_price.min'=>'le prix d achat doit etre un nombre positive',
    //   'moreFields.*.selling_price.numeric'=>'le prix de vente doit entre un nombre ',
    //   'moreFields.*.selling_price.min'=>'le prix de vente doit etre un nombre positive',
    //   'moreFields.*.weight.numeric'=>'le poids doit entre un nombre ',
    //   'moreFields.*.weight.min'=>'le poids doit entre un nombre positive',
       
    //   'moreFields.*.stock.min'=>'
    //   La quantité doit être un entier positive',
    //   'moreFields.*.stock.integer'=>'
    //   La quantité doit être un entier.',

    //     'file_name.mimes' => ' l image doit etre en format pdf, jpeg , png , jpg',
    //     'categorie_id.required' =>'Veuillez choisir une categorie',
        


    //     ]);

    
    
    $products->update([
       
        'name' => $request->name,
        'categorie_id' => $request->categorie_id,
        'description' => $request->description,
        'user' => (Auth::user()->name),
        ]);
      
         
    
  foreach ($request->moreFields as $key => $value) {
            if (isset($value['id'])) {
                sizes::where('id', $value['id'])->update(
                    
          [         
            
               'designation'=>$value['designation'],
                'buying_price'=>$value['buying_price'],
                'selling_price'=>$value['selling_price'],
                'stock'=>$value['stock'],
                'weight'=>$value['weight'],
                ]
                );
            } else {
                $size = new sizes; //new up an empty model(object) then fill it with your array of data, and finally save it.
                $size->fill([
                 'product_id' => $request->product_id,
               'designation'=>$value['designation'],
                'buying_price'=>$value['buying_price'],
                'selling_price'=>$value['selling_price'],
                'stock'=>$value['stock'],
                'weight'=>$value['weight'],
                ])->save();
            }
        }
        
         
     
        
       

        session()->flash('edit', 'Le produit est modifié');
        return redirect('/products');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        $id = $request->id;
        products::find($id)->delete();
        session()->flash('delete','Le produit est supprimé avec succès');
        return redirect('/products');
    }
   
 /*   public function delete(Request $request){

       $sizes = sizes::findOrFail($request->id);
       $sizes->delete();
       session()->flash('delete','Le taille est supprimé avec succés');
        return back();


}*/
public function delete(Request $request){

    if(isset($request->id)){
          $sizes = sizes::findOrFail($request->id);
          $sizes->delete();
          return 'success';

       
    }
}
}
