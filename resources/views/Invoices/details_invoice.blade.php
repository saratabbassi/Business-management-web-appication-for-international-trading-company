@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('title')

    Détails de la facture
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Liste des Factures</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/

                    Détails de la facture</span>
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



    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif



    <!-- row opened -->
    <div class="row row-sm">

        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">Informations</a>
                                            </li>
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">Produits de la
                                                    Facture</a></li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">Etats des Paiments</a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">


                                        <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive mt-15">

                                                <table class="table table-striped" style="text-align:center">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Numéro de facture</th>
                                                            <td>{{ $invoices->invoice_no }}</td>
                                                            <th scope="row">Date :</th>
                                                            <td>{{ $invoices->invoice_Date }}</td>
                                                            <th>Devise : </th>
                                                            <td>{{ $invoices->devise }}</td>


                                                        </tr>
                                                        <tr>
                                                            <th>Nom Client : </th>
                                                            <td>{{ $invoices->customer_name }}</td>
                                                            <th>Adresse Client : </th>
                                                            <td>{{ $invoices->customer_adress }}</td>
                                                            <th>Crée par :</th>
                                                            <td>{{ $invoices->created_by }}</td>

                                                        </tr>
                                                        <tr>

                                                            <th>Poids Brut en Kg : </th>
                                                            <td>{{ $invoices->poids_brut }}</td>
                                                            <th>Poids Net en Kg : </th>
                                                            <td>{{ $invoices->poids_net }}</td>
                                                            <th>Nombre de Colis : </th>
                                                            <td>{{ $invoices->packages }}</td>


                                                        </tr>
                                                        <tr>
                                                            <th>Livraison : </th>
                                                            <td>{{ $invoices->livraison }}</td>
                                                            <th>Details de Paiments : </th>
                                                            <td>{{ $invoices->payment_details }}</td>
                                                            <th>Etat de Paiment : </th>

                                                            @if ($invoices->Value_Status == 1)
                                                                <td><span
                                                                        class="badge badge-pill badge-success">{{ $invoices->Status }}</span>
                                                                </td>
                                                            @elseif($invoices->Value_Status ==2)
                                                                <td><span
                                                                        class="badge badge-pill badge-danger">{{ $invoices->Status }}</span>
                                                                </td>
                                                            @else
                                                                <td><span
                                                                        class="badge badge-pill badge-warning">{{ $invoices->Status }}</span>
                                                                </td>
                                                            @endif
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab5">
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th>Numéro de facture</th>
                                                            <th>Date de creation:</th>
                                                            <th>Etat de paiment:</th>
                                                            <th>Montant Payé:</th>
                                                            <th>Montant Restant:</th>
                                                            <th>Date de paiment :</th>
                                                            <th>Créé par :</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0;
                                                        $montant=0; ?>
                                                        @foreach ($details as $x)
                                                            <?php $i++; ?>
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $x->invoice_number }}</td>
                                                                <td>{{ $x->created_at }}</td>

                                                                @if ($x->Value_Status == 1)
                                                                    <td><span
                                                                            class="badge badge-pill badge-success">{{ $x->Status }}</span>
                                                                    </td>
                                                                @elseif($x->Value_Status ==2)
                                                                    <td><span
                                                                            class="badge badge-pill badge-danger">{{ $x->Status }}</span>
                                                                    </td>
                                                                @else
                                                                    <td><span
                                                                            class="badge badge-pill badge-warning">{{ $x->Status }}</span>
                                                                    </td>
                                                                @endif


                                                                @if ($x->Value_Status == 1)
                                                                <td>{{$x->total_due}}
                                                                </td>
                                                            @elseif($x->Value_Status ==2)
                                                                <td>0
                                                                </td>
                                                            @else
                                                                <td> 
                                                                    @php
                                                                        $montant=$montant+$x->paid_amount;
                                                                    @endphp
                                                                    {{$montant}}
                                                                </td>
                                                            @endif

                                                            @if ($x->Value_Status == 1)
                                                            <td>0
                                                            </td>
                                                        @elseif($x->Value_Status ==2)
                                                            <td>{{$x->total_due}}
                                                            </td>
                                                        @else
                                                            <td> 
                                                                @php
                                                                   $restant= $x->total_due-$montant;
                                                                @endphp
                                                                {{ $restant}}
                                                            </td>
                                                        @endif

                                                                <td>{{ $x->Payment_Date }}</td>


                                                                <td>{{ $x->user }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>


                                        <div class="tab-pane" id="tab6">

                                            <div class="table-responsive">
                                                <table id="example" class="table key-buttons text-md-nowrap "
                                                    data-page-length='50' style="text-align: center">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-bottom-0">#</th>
                                                            <th class="border-bottom-0">Désignation</th>
                                                            <th class="border-bottom-0">Quantité</th>
                                                            <th class="border-bottom-0">Poids en Kg</th>
                                                            <th class="border-bottom-0">Poids Total en Kg</th>
                                                            <th class="border-bottom-0">Prix Unitaire</th>
                                                            <th class="border-bottom-0">MONTANT</th>



                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $i = 0;
                                                        @endphp

                                                        @foreach ($invoices->details as $item)
                                                            @php
                                                                $i++;
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $item->product->name }},{{ $item->size->designation }}
                                                                </td>
                                                                <td>{{ $item->quantity }}</td>
                                                                <td>{{ $item->weight }}</td>
                                                                <td>{{ $item->total_weight }}</td>
                                                                <td>{{ $item->unit_price }}</td>
                                                                <td>{{ $item->total_price }}</td>





                                                            </tr>
                                                                @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /div -->
        </div>

    </div>
    <!-- /row -->

    <!-- delete -->
   
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>

    <script>
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)

            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })

    </script>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

    </script>
   

@endsection
