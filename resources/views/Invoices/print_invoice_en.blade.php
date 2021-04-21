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
                <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
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
                            <h1 class="invoice-title">Invoice</h1>
                            <div class="col-md-1 invoice-info-row">

                                <img src="{{ asset('assets/img/brand/logo.png') }}" class="logo-1" alt="logo">
                            </div>
                            <div class="billed-from">
                                <h6>{{ $invoices->company_name }}</h6>
                                <p>Adress: {{ $invoices->company_adress }}<br>
                                    Phone : {{ $invoices->company_phone }}<br>
                                </p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->

                        <div class="row mg-t-20">
                            <div class="col-md">
                                <label class="tx-gray-600">
                                    Billed to</label>
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
                                <label class="tx-gray-600">Invoice Information</label>
                                <p class="invoice-info-row"><span>
                                        Invoice Number</span> <span>{{ $invoices->invoice_no }}</span></p>

                                <p class="invoice-info-row"><span>Date:</span> <span>{{ $invoices->invoice_date }}</span>
                                </p>
                                <p class="invoice-info-row"><span>Origin:</span> <span>Tunisia</span></p>
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
                                        <th class="tx-center">Quantity</th>
                                        <th class="tx-right">Unit Price</th>
                                        <th class="tx-right">Amount</th>
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
                                        <td class="valign-middle" colspan="2" rowspan="3">
                                            <div class="invoice-notes">


                                            </div><!-- invoice-notes -->
                                        </td>
                                        <td class="tx-right">Sub-Total</td>
                                        <td class="tx-right" colspan="2">{{ number_format( $invoices->sub_total , 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">
                                            Shipping cost</td>
                                        <td class="tx-right" colspan="2">{{ number_format( $invoices->shipping , 2) }}</td>
                                    </tr>



                                    <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">Total Invoice </td>
                                        <td class="tx-right" colspan="2">
                                            <h4 class="tx-primary tx-bold">{{ number_format( $invoices->total_due , 2) }}</h4>
                                        </td>
                                    </tr>


                                </tbody>

                            </table>


                        </div>
                        <br>
                        <span class="tx-bold">Total Amount :  @php
                            echo NumConvert::word($invoices->total_due);

                         @endphp </span>
                        <div class="row mg-t-20">
                           
                          
                           
                            <div class="col-md-3">
                               
                                <p class="invoice-info-row"><span>
                                        
Gross weight: </span> <span> {{ number_format( $invoices->poids_brut , 2) }} kg</span></p>

                                <p class="invoice-info-row"><span>
                                    Net weight:</span>
                                    <span> {{ number_format( $invoices->poids_net , 2) }} kg</span>
                                </p>
                                <p class="invoice-info-row"><span>Number Of packages:</span>
                                    {{ $invoices->packages }}</span>
                                </p>
                                <p class="invoice-info-row"><span>
                                        Delivery:</span> <span>{{ $invoices->livraison }}</span></p>
                                <p class="invoice-info-row"><span>
                                        Incoterm:</span> <span>{{ $invoices->incoterm }}</span></p>
                                <p class="invoice-info-row"><span>Origin:</span> <span>Tunisia</span></p>
                                <p class="invoice-info-row"><span>Paiment Details:</span>
                                    <span>{{ $invoices->payment_details }}</span></p>
                            </div>
                            <div class="col-md">

                            </div>
                        </div>
                        <br>
                        <div>
                            <SPAN>BANKING DETAILS</SPAN> <br>
                            <SPAN>TINAST SCI</SPAN> <br>
                            <span>CODE BIC : UBCITNTT</span> <br>
                            <span>IBAN/ TN 59</span> <br>
                            <span>BANK RIB: 1170.0000.1789.0027.8803 </span> <br>
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
                              <span class="text-muted ">Adress: {{$invoices->company_adress}}</span> <br>
                              <span class="text-muted ">Phone: {{$invoices->company_phone}}</span>
                            </div>
                        </footer>


                        <hr class="mg-b-40">

                        <a href="#" class="btn btn-danger float-left mt-3 mr-2" id="print_Button" onclick="printDiv()">
                            <i class="mdi mdi-printer ml-1"></i>Print
                        </a>
                        <a href="#" class="btn btn-success float-left mt-3" id="send_invoice">
                            <i class="mdi mdi-telegram ml-1"></i>Send Invoice
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
