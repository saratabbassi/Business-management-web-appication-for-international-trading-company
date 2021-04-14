@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput.css') }}">
@endsection
@section('title')
    Modifier Produit
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Produits</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Modifier Produit</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('edit'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('edit') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session()->has('delete'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('delete') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{url ('products/update') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Nom du Produit</label>
                                <input type="hidden" name="product_id" value="{{ $products->id }}">
                                <input type="text" class="form-control" id="inputName" name="name"
                                    title="Saisir le nom du produit " value="{{$products->name}} "  required>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">Categorie</label>
                                <select name="categorie_id" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                
                                    @foreach($categories as $c)
                                    <option value="{{ $c->id }}" {{$products->categorie_id  == $c->id  ? 'selected' : ''}}>{{ $c->categorie_name}}</option>
                                @endforeach
                                </select>
                            </div>
                            
                       


                    </div>

                     
                     
                        <br>
                         {{-- 2--}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">Description</label>
                                <textarea  class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            </div>
                        </div><br>

                        {{-- 3--}}
                        <h5 class="card-title"> Les différentes tailles Disponible</h5>
                        <br>

                        <table class="table table-bordered" id="dynamicAddRemove">
                            <tr>
                                <th>Désignation</th>
                                <th>Prix d'achat</th>
                                <th>Prix de vente</th>
                                <th>Stock</th>
                                <th>Pois</th>
                                <th>Opérations</th>
                            </tr>
                            @php
												$s=0;
											@endphp
                            @foreach ($sizes as $size)
                            
                            
                            <tr>
                                <input type="hidden" name="moreFields[{{ $s }}][id]" value="{{ $size->id }}">
                                <td><input type="text" name="moreFields[{{ $s }}][designation]" value="{{ $size->designation }}"  placeholder="Entrer designation"
                                        class="form-control" required /></td>
                                <td><input type="text" name="moreFields[{{ $s }}][buying_price]" value="{{ $size->buying_price }}"  placeholder="Entrer le prix d achat"
                                        class="form-control" required /></td>
                                <td><input type="text" name="moreFields[{{ $s }}][selling_price]" value="{{ $size->selling_price }}"  placeholder="Entrer le prix de vente"
                                        class="form-control" required /></td>
                                <td><input type="text" name="moreFields[{{ $s }}][stock]" value="{{ $size->stock }}"  placeholder="Entrer le stock"
                                        class="form-control" required /></td>
                                <td><input type="text" name="moreFields[{{ $s }}][weight]" value="{{ $size->weight }}" placeholder="Entrer le pois"
                                        class="form-control" required /></td>
                                      
                                       
                                       @if ( $s == 0)
                                 <td>  <button type="button" name="add" id="add-btn" class="btn btn-success">Ajouter plus</button></td>    
                                       @else
                                
                                <!--    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-id="" data-name=""
                                            data-toggle="modal" href="#modaldemo9" title="Supprimer"><i
                                                class="las la-trash"></i></a> -->
                                                <td><button type="button" class="btn btn-danger deletebtn remove-tr" data-sizeid="{{$size->id}}" >Supprimer</button>
                                  </td>
                                       @endif
                              
                            </tr> 
                               @php
                                $s++;
                                @endphp
                       
                            @endforeach
                         
                        </table>
                        <br>
                       
<br>


                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->

     <!-- delete -->
     <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Supprimer Produit </h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="/delete" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>Voulez-vous supprimer le produit ?</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="name" id="name" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                        <button type="submit" class="btn btn-danger">Oui</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
   
    <script type="text/javascript">
       
        var i = '<?php echo $s; ?>';
        $("#add-btn").click(function(){
        ++i;
        $("#dynamicAddRemove").append('<tr> <td><input type="text" name="moreFields['+i+'][designation]"  placeholder="Enter designation" class="form-control" required /></td><td><input type="text" name="moreFields['+i+'][buying_price]" placeholder="Entrer le proix d achat" class="form-control" required /></td><td><input type="text" name="moreFields['+i+'][selling_price]" placeholder="Entrer le prix de vente" class="form-control" required /></td><td><input type="text" name="moreFields['+i+'][stock]" placeholder="Entrer le stock" class="form-control" required /></td><td><input type="text" name="moreFields['+i+'][weight]" placeholder="Entrer le pois" class="form-control" required /></td><td><button type="button" class="btn btn-danger remove-tr ">Supprimer</button></td></tr>');
        });
        $(document).on('click', '.remove-tr', function(){  
        $(this).parents('tr').remove();
        });
       
        $(".deletebtn").click(function(ev){
    let sizeid = $(this).attr("data-sizeid");
    $.ajax({
               type: 'DELETE',
               url: '/delete',
               dataType: 'json',
               headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
               data: {id:sizeid,"_token": "{{ csrf_token() }}"},

               success: function (data) {
                console.log(whichIsVisible());            
               },
               error: function (data) {
                console.log(whichIsVisible());
               }
    });
});



  

        </script>
      

    @endsection