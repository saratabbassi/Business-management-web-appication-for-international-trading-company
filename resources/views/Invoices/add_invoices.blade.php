@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection
@section('title')
    Ajouter Produit
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Factures</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Ajouter Facture</span>
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

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
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


                    <form action="{{ route('invoices.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">

                            <div class="col">

                                <label for="inputName" class="control-label">Dernier numéro de facture</label>
                                <input type="text" class="form-control" id="last_invoice_no" name="last_invoice_no"
                                    value="{{ $last }}" readonly>
                            </div>
                            <div class="col">

                                <label for="inputName" class="control-label">Numéro de Facture</label>
                                <input type="text" class="form-control" id="invoice_no" name="invoice_no"
                                    title="Saisir le nom du produit ">
                            </div>
                            <div class="col">
                                <label>Date</label>
                                <input class="form-control fc-datepicker" data-date-format="dd-mm-yyyy" name="invoice_date"
                                    id="invoice_date" placeholder="DD-MM-YYYY" type="text" value="{{ date('d-m-Y') }}">
                            </div>

                            <div class="col ">

                                <label for="inputName" class="control-label">Devise</label>

                                <select name="devise" class="form-control select2" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <option value="">Choisir Devise</option>
                                    @foreach ($devises as $d)

                                        <option value="{{ $d->devise }}"> {{ $d->devise }}</option>
                                    @endforeach

                                </select>

                            </div>


                        </div>

                        {{-- 2 --}}
                        <br>


                        <div class="row">



                            <div class="col ">


                                <label for="inputName" class="control-label">Client</label>



                                <select id="customer_name" name="customer_name" class="form-control select2 "
                                    onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                                    <option value="">Choisir Client</option>
                                    @foreach ($customers as $c)

                                        <option value="{{ $c->customer_name }}" adress="{{ $c->customer_adress }}">
                                            {{ $c->customer_name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Adresse du client</label>
                                <input type="text" class="form-control" id="customer_adress" name="customer_adress"
                                    title="Saisir le nom du produit " readonly>
                            </div>

                        </div>

                        {{-- 3 --}}
                        <br>
                        <div class="row">


                            <div class="col">
                                <label for="inputName" class="control-label">Nom Societé</label>
                                <input type="text" class="form-control" id="company_name" name="company_name"
                                    title="Saisir le nom du produit " value="TINAST SCI">

                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">Adresse societé</label>
                                <input type="text" class="form-control" id="company_adress" name="company_adress"
                                    title="Saisir le nom du produit " value="Agareb Sfax 3030">
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">Tel</label>
                                <input type="text" class="form-control" id="company_phone" name="company_phone"
                                    title="Saisir le nom du produit " value="+216 26 566 627">
                            </div>


                        </div>

                        {{-- 4 --}}
                        <br>
                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">Le nombre de colis</label>
                                <input type="text" class="form-control" id="packages" name="packages">
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">Livraison</label>
                                <input type="text" class="form-control" id="livraison" name="livraison"
                                    title="Saisir le nom du produit ">
                            </div>
                            <div class="col ">


                                <label for="inputName" class="control-label">Incoterm</label>



                                <select id="incoterm" name="incoterm" class="form-control select2 "
                                    onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                                    <option value="">Choisir Incoterm</option>
                                    @foreach ($incoterms as $i)

                                        <option value="{{ $i->id }}">{{ $i->incoterm }}</option>
                                    @endforeach

                                </select>



                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">Détails de paiement</label>
                                <input type="text" class="form-control" id="payment_details" name="payment_details">
                            </div>
                        </div>

                        {{-- 5 --}}
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label"><br></label>
                                <div class="product-details table-responsive text-nowrap">
                                    <h5>Liste Des produits</h5>
                                    <br>
                                    <table class="table table-bordered" id="dynamicAddRemove">
                                        <thead>
                                            <tr>

                                                <th style="width: 16.66%" scope="col">Catégorie du produit</th>
                                                <th style="width: 20%" scope="col">Produit</th>
                                                <th style="width: 20%" scope="col">Designation</th>
                                                <th style="width: 9%" scope="col">Quantité</th>
                                           
                                                <th scope="col">Prix unitaire</th>
                                                <th scope="col">Prix total</th>
                                                <th style="display: none" scope="col">Prix total</th>
                                                <th style="display: none" scope="col">Prix total</th>


                                                <th scope="col"><a class="btn btn-success btn-sm add_more "><i
                                                            class="fas fa-plus"></i></a></th>
                                            </tr>
                                        </thead>
                                        <tbody class="addMoreProduct">


                                            <tr>

                                                <td>
                                                    <select name="categorie_id[0]" id="categorie_id"
                                                        class="form-control categorie_id ">
                                                        <option label="Choisir Categorie"></option>
                                                        @foreach ($categories as $categorie)
                                                            <option value="{{ $categorie->id }}">
                                                                {{ $categorie->categorie_name }}
                                                            </option>
                                                        @endforeach


                                                    </select>
                                                </td>
                                                <td> <select name="product_id[0]" id="product_id"
                                                        class="form-control product_id ">
                                                        <option label="Choisir Produit"></option>



                                                    </select></td>
                                                <td> <select name="size_id[0]" id="size_id" class="form-control size_id ">

                                                        <option label="Choisir Designation"></option>

                                                    </select></td>



                                                <td>

                                                    <input type="text" name="quantity[0]" class="form-control quantity" value="0" />
                                                </td>
                                                <td style="display:none;">
                                                    <input type="hidden" name="weight[0]" class="form-control weight "
                                                        readonly />
                                                </td>
                                                <td style="display:none;">
                                                    <input type="hidden" name="total_weight[0]"
                                                        class="form-control total_weight " readonly />
                                                </td>
                                                <td>
                                                    <input type="text" name="unit_price[0]"
                                                        class="form-control unit_price " />
                                                </td>
                                                <td>

                                                    <input type="text" name="total_price[0]"
                                                        class="form-control total_price" readonly />
                                                </td>
                                                <td>

                                                </td>
                                                <td style="display:none;">

                                                    <input type="hidden" name="buying_price[0]"
                                                        class="form-control buying_price"   />
                                                </td>
                                                <td style="display:none;">

                                                    <input type="hidden" name="benefice[0]"
                                                        class="form-control benefice"   />
                                                </td>

                                                

                                            </tr>
                                        </tbody>

                                    </table>

                                    <div class="invoice_details">

                                        <div class="row">
                                            <div class="col ">
                                                <label for="poids_net">Poids net en Kg</label>
                                                <input type="text" id="poids_net" name="poids_net"
                                                    class="form-control poids_net" value="0">
                                            </div>
                                            <div class="col"></div>
                                            <div class="col"></div>
                                            <div class="col ml-auto" >

                                                <label for="sub_total">Sub Total</label>
                                                <input type="text" id="sub_total" name="sub_total"
                                                    class="form-control sub_total" value="0" readonly>
                                            </div>
                                            <div class="col ml-auto" style="display: none">

                                              
                                                <input type="hidden" id="total_ben" name="total_ben"
                                                    class="form-control total_ben" value="0" readonly>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col ">

                                                <label for="poids_emballage">Poids d'emballage en Kg</label>

                                                <input type="text" id="poids_emballage" name="poids_emballage"
                                                    class="form-control poids_emballage" value="0">
                                            </div>
                                            <div class="col"></div>
                                            <div class="col"></div>
                                            <div class="col ml-auto ">

                                                <label for="shipping">Shipping Costs</label>

                                                <input type="text" id="shipping" name="shipping"
                                                    class="form-control shipping" value="0">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col ml-auto">

                                                <label for="poids_brut">Poids Brut en Kg</label>
                                                <input type="text" id="poids_brut" name="poids_brut"
                                                    class="form-control poids_brut" value="0" readonly>
                                            </div>

                                            <div class="col"></div>
                                            <div class="col"></div>
                                            <div class="col">

                                                <label for="total_due">Total Due</label>
                                                <input type="text" id="total_due" name="total_due"
                                                    class="form-control total_due" value="0" readonly>
                                            </div>

                                        </div>
                                        <br>
                                    </div>
                                </div>


                                <br>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>


                    </form>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Grid modal -->
    </div>
    </div>
    </div>
    <!-- End Basic modal -->






    <!-- row closed -->
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'dd-mm-yy'
        }).val();

    </script>


    <script>
        $(function() {
            $('select[name="customer_name"]').change(function() {
                var option = $('option:selected', this).attr('adress');



                $('input[name="customer_adress"]').val(option);
            })

        })

    </script>


    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

    </script>

    <script>
        var i = 0;

        $('.add_more').on('click', function() {

            ++i;
            var categorie = $('.categorie_id').html();


            var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;

            var tr = '<tr>' +
                '<td> <select class="form-control categorie_id  "  id="categorie_id" name="categorie_id[' + i +
                ']" >' + categorie +
                '</select></td>' +
                '<td>  <select class="form-control product_id  "  id=product_id" name="product_id[' + i +
                ']" ><option label="Choisir Produit"></option></select></td>' +
                '<td>  <select class="form-control size_id  "  id="size_id" name="size_id[' + i +
                ']" ><option label="Choisir Designation"></option></select></td>' +
                '<td> <input type="text" name="quantity[' + i + ']" class="form-control quantity" value="0" ></td>' +
                '<td style="display:none;"> <input type="hidden" name="weight[' + i + ']" class="form-control weight" readonly></td>' +
                '<td style="display:none;"> <input type="hidden" name="total_weight[' + i +
                ']" class="form-control total_weight" readonly ></td>' +
                '<td> <input type="text" name="unit_price[' + i + ']" class="form-control unit_price" ></td>' +

                '<td> <input type="text" name="total_price[' + i +
                ']" class="form-control total_price" readonly></td>' +
                '<td style="display:none;"> <input type="hidden" name="buying_price[' + i + ']" class="form-control buying_price" ></td>' +
                '<td style="display:none;"> <input type="hidden" name="benefice[' + i + ']" class="form-control benefice" ></td>' +
                '<td> <a class="btn btn-danger btn-sm delete "><i class="fa fa-trash"></a></td></tr>';


            $('.addMoreProduct').append(tr);


        });
        $('.addMoreProduct').delegate('.delete', 'click', function() {
            $(this).parent().parent().remove();
        });

    </script>
    <script>
        $(document).on('change', 'select[name^="categorie_id"]', function() {
            var curEle = jQuery(this);
            var categorieID = curEle.val();
            var parentEle = curEle.closest('tr');
            var prodEle = parentEle.find('select[name^="product_id"]');
            var sizeEle = parentEle.find('select[name^="size_id"]');
            sizeEle.empty();
            prodEle.empty();

            if (categorieID) {
                jQuery.ajax({
                    url: '/getProducts/' + categorieID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        prodEle.append(' <option label="Choisir Produit"></option>');
                        sizeEle.append(' <option label="Choisir Designation"></option>');
                        jQuery.each(data, function(key, value) {
                            prodEle.append('<option value="' + key + '">' + value +
                                '</option>');
                        });
                    }
                });
            }
        });

    </script>
    <script>
        $(document).on('change', 'select[name^="product_id"]', function() {
            var cur = jQuery(this);
            var productID = cur.val();
            var parent = cur.closest('tr');

            var sizeEle = parent.find('select[name^="size_id"]');
            sizeEle.empty();


            if (productID) {
                jQuery.ajax({
                    url: '/getDesignation/' + productID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        sizeEle.append(' <option label="Choisir Designation"></option>');
                        jQuery.each(data, function(key, value) {
                            sizeEle.append('<option value="' + value.id + '" data-price="' +
                                value.selling_price + '" data-weight="' + value.weight + '" data-buy="' + value.buying_price +
                                '">' + value.designation +
                                '</option>');

                        });
                    }
                });
            }
        });

    </script>

    <script>
        function TotalAmount() {
            var total = 0;

            $('.total_price').each(function(i, e) {
                var amount = $(this).val() - 0;
                total += amount;

            })
            var subtotal = total;
            $('.sub_total').val(subtotal);
        }

    </script>
    <script>
        function TotalWeight() {
            var weight = 0;

            $('.total_weight').each(function(i, e) {
                var amount = $(this).val() - 0;
                weight += amount;

            })
            var subtotal = weight;
            $('.poids_net').val(subtotal);
        }

    </script>
     <script>
        function TotalBenefice() {
            var b = 0;

            $('.benefice').each(function(i, e) {
                var ben = $(this).val() - 0;
                b += ben;

            })
            var bb = b;
            $('.total_ben').val(bb);
        }

    </script>

    <script>
        let due_total = function() {
            let due = 0;
            let sub_totalVal = parseFloat($('.sub_total').val()) || 0;
            let shippingVal = parseFloat($('.shipping').val()) || 0;
            due += sub_totalVal;
            due += shippingVal;
            return due;
        }

    </script>
    <script>
        let gross_weight = function() {
            let w = 0;
            let poids_net = parseFloat($('.poids_net').val()) || 0;
            let poids_emballage = parseFloat($('.poids_emballage').val()) || 0;
            w += poids_net;
            w += poids_emballage;
            return w;
        }

    </script>
 




    <script>
        $('.addMoreProduct').delegate('.size_id', 'change', function() {

            var tr = $(this).parent().parent();
            var price = tr.find('.size_id option:selected').attr('data-price');
            tr.find('.unit_price').val(price);
            var qty = tr.find('.quantity').val() - 0;
            var totalprice = (qty * price);
            tr.find('.total_price').val(totalprice);
            TotalAmount();
            $('.total_due').val(due_total());

            var weight = tr.find('.size_id option:selected').attr('data-weight');
            tr.find('.weight').val(weight);
            var totalweight = (qty * weight);
            tr.find('.total_weight').val(totalweight);
            TotalWeight();
            $('.poids_brut').val(gross_weight());

            var buying = tr.find('.size_id option:selected').attr('data-buy');
            tr.find('.buying_price').val(buying);
            
            var benefice = (qty * (price - buying));
            tr.find('.benefice').val(benefice);
            TotalBenefice();
           



        });
        $('.addMoreProduct').delegate('.quantity,.unit_price', 'keyup', function() {
            var tr = $(this).parent().parent();
            var qty = tr.find('.quantity').val() - 0;
            var price = tr.find('.unit_price').val() - 0;
            var totalprice = (qty * price);
            tr.find('.total_price').val(totalprice);
            TotalAmount();
            $('.total_due').val(due_total());

            var weight = tr.find('.weight').val() - 0;
            var totalweight = (qty * weight);
            tr.find('.total_weight').val(totalweight);
            TotalWeight();
            $('.poids_brut').val(gross_weight());

             var buying = tr.find('.buying_price').val() - 0;;
           
            
            var benefice = (qty * (price - buying));
            tr.find('.benefice').val(benefice);
            TotalBenefice();



        })
        $('.invoice_details').delegate('.shipping', 'keyup', function() {


            $('.total_due').val(due_total());

        })
        $('.invoice_details').delegate('.poids_emballage', 'keyup', function() {


            $('.poids_brut').val(gross_weight());

        })
     

    </script>







@endsection
