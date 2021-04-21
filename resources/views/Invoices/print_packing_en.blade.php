@extends('layouts.master')
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }

            #send_invoice {
                display: none;
            }

            footer {
                position: fixed;
                bottom: 0;
            }

            header {
                position: fixed;
                top: 0
            }
        }

        @page {
            margin: 0;
        }

    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Packing List</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Print</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">

                            <h1 class="invoice-title ">Packing List</h1>
                            <div class="col-md-1 invoice-info-row ">

                                <img src="{{ asset('assets/img/brand/logo.png') }}" class="logo-1 " alt="logo">
                            </div>
                            <div class="billed-from">
                                <h6>{{ $invoices->company_name }}</h6>
                                <p>Adresse: {{ $invoices->company_adress }}<br>
                                    Tel : {{ $invoices->company_phone }}<br>
                                </p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->

                        <div class="row mg-t-20">

                            <div class="col-md">
                                <label class="tx-gray-600">Informations </label>
                                <p class="invoice-info-row"><span>
                                        Date:</span> <span>{{ $invoices->invoice_date }}</span></p>

                                <p class="invoice-info-row"><span>
                                        numéro de commande:</span> <span>{{ $invoices->invoice_date }}</span>
                                </p>
                                <p class="invoice-info-row"><span>Expédiés à:</span>
                                    <span>{{ $invoices->customer_name }}</span></p>
                                <p class="invoice-info-row"><span>
                                        Adresse:</span> <span>{{ $invoices->customer_adress }}</span></p>
                            </div>
                            <div class="col-md">

                            </div>
                        </div>
                        <div class="table-responsive mg-t-50">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="wd-40p">Designation</th>
                                        <th class="tx-center">Quantité expédiée</th>

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
                                            <td class="tx-12">{{ $item->product->name }},
                                                {{ $item->size->designation }}
                                            </td>
                                            <td class="tx-center">{{ $item->quantity }}</td>

                                        </tr>
                                    @endforeach
                                    @php
                                        $q = 0;
                                    @endphp
                                    @foreach ($invoices->details as $item)
                                        @php
                                            $q = $q + $item->quantity;
                                        @endphp

                                    @endforeach



                                    <tr>
                                        <td></td>
                                        <td class=" tx-uppercase tx-bold tx-inverse">Total </td>
                                        <td  colspan="1">
                                            <h4 class="tx-primary tx-center tx-bold">{{ $q }}
                                            </h4>
                                        </td>
                                    </tr>


                                </tbody>

                            </table>


                        </div>
                        <div class="row mg-t-20">

                            <div class="col-md-3">
                               <br> <br>
                                <p class="invoice-info-row"><span>
                                        Poids brut: </span> <span>{{ $invoices->poids_brut }} kg</span></p>

                                <p class="invoice-info-row"><span>Poids net:</span>
                                    <span>{{ $invoices->poids_net }} kg</span>
                                </p>
                                <p class="invoice-info-row"><span>Nombre de colis:</span>
                                   {{ $invoices->packages }}</span>
                                </p>
                                <p class="invoice-info-row"><span>
                                        Livraison:</span> <span>{{ $invoices->livraison }}</span></p>
                                <p class="invoice-info-row"><span>
                                        Incoterm:</span> <span>{{ $invoices->incoterm }}</span></p>
                                <p class="invoice-info-row"><span>Origine:</span> <span>Tunisie</span></p>
                                <p class="invoice-info-row"><span>Détails de paiement:</span>
                                    <span>{{ $invoices->payment_details }}</span>
                                </p>
                            </div>
                            <div class="col-md">

                            </div>
                        </div>
                        <br>
                        

                        <div class="row mg-t-20">
                            <div class="col-md-8">

                            </div>
                            <div class="col-md-2 invoice-info-row">
                                <p></p>
                                <img src="{{ asset('assets/img/brand/stamp.png') }}" class="logo-1" alt="logo">
                            </div>
                        </div>
                        <footer>
                            <div class="container text-center">
                                <span class="text-muted ">TINAST SCI SUARL</span> <br>
                                <span class="text-muted ">TVA CODE: 000 M A 1644718 V</span> <br>
                                <span class="text-muted ">Adresse: {{ $invoices->company_adress }}</span> <br>
                                <span class="text-muted ">Tel: {{ $invoices->company_phone }}</span>
                            </div>
                        </footer>


                        <hr class="mg-b-40">

                        <a href="#" class="btn btn-danger float-left mt-3 mr-2" id="print_Button" onclick="printDiv()">
                            <i class="mdi mdi-printer ml-1"></i>Imprimer
                        </a>
                        <a href="#" class="btn btn-success float-left mt-3" id="send_invoice">
                            <i class="mdi mdi-telegram ml-1"></i>Envoyer Facture
                        </a>
                    </div>

                </div>

            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }

    </script>
@endsection
