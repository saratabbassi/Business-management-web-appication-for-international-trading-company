@extends('layouts.master')
@section('title')

    Factures Non Payées
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Factures</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  Factures Non Payées</span>
            </div>
        </div>


    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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
    @if (session()->has('delete_invoice'))
    <script>
        window.onload = function() {
            notif({
                msg: "La Facture est supprimer avec succés",
                type: "success"
            })
        }
    </script>
@endif


@if (session()->has('Status_Update'))
    <script>
        window.onload = function() {
            notif({
                msg: "L'etat de paiement est modifier avec succés",
                type: "success"
            })
        }
    </script>
@endif
    <div row>
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">


                    <a href="invoices/create" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                            class="fas fa-plus"></i> &nbsp;Céer Facture</a>

                    <a class="modal-effect btn btn-sm btn-success" href="{{ url('export_invoices') }}"
                        style="color:white"><i class="fas fa-file-download"></i>&nbsp;Exporter Excel</a>



                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap " data-page-length='50'
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Numéro </th>
                                    <th class="border-bottom-0">Client</th>
                                    <th class="border-bottom-0">Date</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Crée par</th>
                                    <th class="border-bottom-0">Imprimer </th>

                                    <th class="border-bottom-0">Operations</th>


                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                               
                                @foreach ($invoices as $invoice)
                                    @php
                                        $i++;
                                    @endphp

                                    <td>{{ $i }}</td>
                                    <td>{{ $invoice->invoice_no }} </td>
                                    <td>{{ $invoice->customer_name }}</td>
                                    <td>{{ $invoice->invoice_date }}</td>
                                    <td>
                                        @if ($invoice->Value_Status == 1)
                                            <span class="text-success">{{ $invoice->Status }}</span>
                                        @elseif($invoice->Value_Status == 2)
                                            <span class="text-danger">{{ $invoice->Status }}</span>
                                        @else
                                            <span class="text-warning">{{ $invoice->Status }}</span>
                                        @endif

                                    </td>
                                    <td>{{ $invoice->created_by }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                type="button">Imprimer<i class="fas fa-caret-down ml-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item" href="Print_proforma_fr/{{ $invoice->id }}"><i
                                                        class="text-info fas fa-print"></i>&nbsp;&nbsp;Proforma Facture FR

                                                </a>
                                                <a class="dropdown-item" href="Print_proforma_en/{{ $invoice->id }}"><i
                                                        class="text-info fas fa-print"></i>&nbsp;&nbsp;Proforma Facture ANG

                                                </a>


                                                <a class="dropdown-item" href="Print_packing_fr/{{ $invoice->id }}"><i
                                                        class="text-primary fas fa-print"></i>&nbsp;&nbsp;Liste De Colisage
                                                    FR

                                                </a>
                                                <a class="dropdown-item" href="Print_packing_en/{{ $invoice->id }}"><i
                                                        class="text-primary fas fa-print"></i>&nbsp;&nbsp;Liste De Colisage
                                                    ANG

                                                </a>
                                                <a class="dropdown-item" href="Print_invoice_fr/{{ $invoice->id }}"><i
                                                        class="text-success fas fa-print"></i>&nbsp;&nbsp;Facture FR

                                                </a>
                                                <a class="dropdown-item" href="Print_invoice_en/{{ $invoice->id }}"><i
                                                        class="text-success fas fa-print"></i>&nbsp;&nbsp;Facture ANG

                                                </a>


                                            </div>
                                        </div>

                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                type="button">Opérations<i class="fas fa-caret-down ml-1"></i></button>
                                            <div class="dropdown-menu tx-13">

                                                <a class="dropdown-item" data-effect="effect-scale"
                                                    href="{{ url('edit_invoice') }}/{{ $invoice->id }}"
                                                    title="Modifier"><i class="text-info fas fa-pen-alt"></i>&nbsp;&nbsp;
                                                    Modifier</a>



                                                <a class="dropdown-item" data-id="{{ $invoice->id }}"
                                                    data-name="{{ $invoice->invoice_no }}" data-toggle="modal"
                                                    href="#modaldemo9" title="Supprimer"><i
                                                        class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;
                                                    Supprimer</a>
                                             
                                                    <a class="dropdown-item"
                                                    href="{{ URL::route('Status_show', [$invoice->id]) }}"><i
                                                        class=" text-success fas
                                                    fa-money-bill"></i>&nbsp;&nbsp;   Changer l'état de paiment
                                                    </a>



                                                <a class="dropdown-item"
                                                    href="{{ url('InvoicesDetails') }}/{{ $invoice->id }}"><i
                                                        class="text-primary fas fa-eye"></i>&nbsp;&nbsp;
                                                    Afficher les détails
                                                </a>

                                            </div>
                                        </div>

                                    </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

               


                <!-- delete -->
                <div class="modal" id="modaldemo9">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">Supprimer Facture </h6><button aria-label="Close" class="close"
                                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="invoices/destroy" method="post">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <p>Voulez-vous supprimer la facture ?</p><br>
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
                 <!-- update paiment -->
                
            </div>

            <!--/div-->






        @endsection
        @section('js')
            <!-- Internal Data tables -->
            <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>


            <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
            <!--Internal  Datatable js -->
            <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
            <script>
                $('#modaldemo9').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget)
                    var id = button.data('id')
                    var name = button.data('name')
                    var modal = $(this)
                    modal.find('.modal-body #id').val(id);
                    modal.find('.modal-body #name').val(name);
                })

            </script>
        @endsection
