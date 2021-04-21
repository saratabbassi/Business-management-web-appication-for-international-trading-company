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
                <h4 class="content-title mb-0 my-auto">Proforma Factures</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Imprimer</span>
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
                            <h1 class="invoice-title">Proforma Facture</h1>
                            <div class="col-md-1 invoice-info-row">

                                <img src="{{ asset('assets/img/brand/logo.png') }}" class="logo-1" alt="logo">
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
                                <label class="tx-gray-600">
                                    Facturé à</label>
                                <div class="billed-to">
                                    <h6>{{ $invoices->customer_name }}</h6>
                                    <p>{{ $invoices->customer_adress }}<br>
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="row mg-t-20">
                            <div class="col-md">

                            </div>
                            <div class="col-md">
                                <label class="tx-gray-600">Informations sur la proforma facture</label>
                                <p class="invoice-info-row"><span>
                                        Numéro de proforma facture</span> <span>{{ $invoices->invoice_no }}</span></p>

                                <p class="invoice-info-row"><span>Date:</span> <span>{{ $invoices->invoice_date }}</span>
                                </p>
                                <p class="invoice-info-row"><span>Origine:</span> <span>Tunisie</span></p>
                                <p class="invoice-info-row"><span>
                                        Devise:</span> <span>{{ $invoices->devise }}</span></p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="wd-40p">Designation</th>
                                        <th class="tx-center">Quantité</th>
                                        <th class="tx-right">Prix ​​unitaire</th>
                                        <th class="tx-right">Montant</th>
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
                                            
                                            <td class="tx-right">{{ number_format( $item->unit_price , 2) }}</td>
                                            <td class="tx-right">{{ number_format( $item->total_price , 2) }}</td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td class="valign-middle" colspan="2" rowspan="2">
                                            <div class="invoice-notes">


                                            </div><!-- invoice-notes -->
                                        </td>
                                      
                                   



                                    <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">Total de la facture </td>
                                        <td class="tx-right" colspan="2">
                                            <h4 class="tx-primary tx-bold">{{ number_format( $invoices->sub_total , 2) }}</h4>
                                        </td>
                                    </tr>


                                </tbody>

                            </table>
@php

    $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
         
@endphp
                           
                        </div>
                        <br>
                        <span class="tx-bold">Arrêter la présente facture à la somme de : {{$f->format($invoices->sub_total)}} </span>
                        <div class="row mg-t-20">

                            <div class="col-md-3">
                                                              
                              <p class="invoice-info-row"><span>
                                        Incoterm:</span> <span>{{ $invoices->incoterm }}</span></p>
                                <p class="invoice-info-row"><span>Origine:</span> <span>Tunisie</span></p>
                                <p class="invoice-info-row"><span>Détails de paiement:</span>
                                    <span>{{ $invoices->payment_details }}</span></p>
                            </div>
                            <div class="col-md">

                            </div>
                        </div>
                        <br>
                        <div>
                            <SPAN>COORDONNÉES BANCAIRES</SPAN> <br>
                            <SPAN>TINAST SCI</SPAN> <br>
                            <span>CODE BIC : UBCITNTT</span> <br>
                            <span>IBAN/ TN 59</span> <br>
                            <span>RIB BANCAIRE: 1170.0000.1789.0027.8803 </span> <br>
                        </div>

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
                              <span class="text-muted ">Adresse: {{$invoices->company_adress}}</span> <br>
                              <span class="text-muted ">Tel: {{$invoices->company_phone}}</span>
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
