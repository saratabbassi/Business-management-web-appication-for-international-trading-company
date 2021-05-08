@extends('layouts.master')
@section('title')
    Tableau de Bord
@stop
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Bienvenue {{ Auth::user()->name }} !</h2>
                <p class="mg-b-0">Tableau de Bord , Tinast SCI</p>
            </div>
        </div>

    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">

                            Total des Factures</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    {{ number_format(\App\invoices::sum('total_due'), 2) }}</h4>
                                <p class="mb-0 tx-12 text-white op-7">Nombres : {{ \App\invoices::count() }}</p>
                            </div>
                            <span class=" my-auto ml-auto">

                                <span class="text-white op-7">100%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">


                            Factures Non Payées</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    {{ number_format(\App\invoices::where('Value_Status', 2)->sum('total_due'), 2) }}</h4>
                                <p class="mb-0 tx-12 text-white op-7">Nombres :
                                    {{ \App\invoices::where('Value_Status', 2)->count() }}</p>
                            </div>
                            <span class=" my-auto ml-auto">

                                <span class="text-white op-7">
                                    @php
                                        $count_all = \App\invoices::count();
                                        $count_invoices2 = \App\invoices::where('Value_Status', 2)->count();
                                        if ($count_invoices2 == 0) {
                                            $count_invoices2 = 0;
                                        } else {
                                            $count_invoices2 = ($count_invoices2 / $count_all) * 100;
                                        }
                                    @endphp
                                    {{ round($count_invoices2) }}%
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">

                    3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">Factures Payées</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    {{ number_format(\App\invoices::where('Value_Status', 1)->sum('total_due'), 2) }}</h4>
                                <p class="mb-0 tx-12 text-white op-7">Nombre :
                                    {{ \App\invoices::where('Value_Status', 1)->count() }}</p>
                            </div>
                            <span class=" my-auto ml-auto">

                                <span class="text-white op-7"> @php
                                    $count_all = \App\invoices::count();
                                    $count_invoices1 = \App\invoices::where('Value_Status', 1)->count();
                                    if ($count_invoices1 == 0) {
                                        $count_invoices1 = 0;
                                    } else {
                                        $count_invoices1 = ($count_invoices1 / $count_all) * 100;
                                    }
                                @endphp
                                    {{ round($count_invoices1) }}%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10,20</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">Factures Partiellement Payées</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    {{ number_format(\App\invoices::where('Value_Status', 3)->sum('total_due'), 2) }}
                                </h4>
                                <p class="mb-0 tx-12 text-white op-7">Nombres :
                                    {{ \App\invoices::where('Value_Status', 3)->count() }}</p>
                            </div>
                            <span class=" my-auto ml-auto">

                                <span class="text-white op-7">@php
                                    $count_all = \App\invoices::count();
                                    $count_invoices1 = \App\invoices::where('Value_Status', 3)->count();
                                    if ($count_invoices1 == 0) {
                                        $count_invoices1 = 0;
                                    } else {
                                        $count_invoices1 = ($count_invoices1 / $count_all) * 100;
                                    }
                                @endphp
                                    {{ round($count_invoices1) }}%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-7">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">
                            Produits en rupture de stock</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>

                </div>
                <div class="card-body" style="width: 70%">
                    @php
                        $i = 0;
                        $j = 0;
                    @endphp
                    @foreach ($sizes as $size)
                        @php
                            $j++;
                        @endphp
                        @if ($size->stock == 0 and $i < 4)
                            @php
                                $i++;
                            @endphp



                            <div class="list-group-item d-flex align-items-center">
                                
                                              
                                          



                                <div class="px-5">

                                    <h6 class="tx-15 mb-1 tx-inverse tx-semibold mg-b-0">
                                        @foreach ($products as $product)
                                            @if ($size->product_id == $product->id)
                                            <span style="color: red" > {{ $product->name }}</span>   
                                            @endif
                                        @endforeach
                                    </h6>
                                    <span class="d-block tx-13 text-muted">{{ $size->designation }}</span>
                                </div>

                            </div>







                        @endif
                    @endforeach



                </div>



            </div>
        </div>


        <div class="col-lg-12 col-xl-5">
            <div class="card card-dashboard-map-one">
                <label class="main-content-label">Revenus du dernier mois </label>
                <div class="" style="width: 100%">
                    {!! $chartjs_2->render() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-4 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header pb-1">
                    <h3 class="card-title mb-2">Clients récents</h3>

                </div>
                <div class="card-body p-0 customers mt-1">
                    @foreach ($invoices as $invoice)
                        <div class="list-group list-lg-group list-group-flush">




                            <div class="list-group-item list-group-item-action" href="#">

                                <div class="media mt-0">

                                    <div class="media-body">
                                        <div class="d-flex align-items-center">
                                            <div class="mt-1">
                                                <h5 class="mb-1 tx-15">{{ $invoice->customer_name }}</h5>
                                                <p class="mb-0 tx-13 text-muted">Numéro de Facture:
                                                    {{ $invoice->invoice_no }}
                                                    @if ($invoice->Value_Status == 1)
                                                        <span class="text-success  ml-2">{{ $invoice->Status }}</span>
                                                    @elseif($invoice->Value_Status == 2)
                                                        <span class="text-danger  ml-2">{{ $invoice->Status }}</span>
                                                    @else
                                                        <span class="text-warning  ml-2">{{ $invoice->Status }}</span>
                                                    @endif
                                                </p>

                                            </div>
                                        </div>
                                    </div>

                                </div>



                            </div>

                        </div>
                    @endforeach

                </div>
            </div>


        </div>
        <!-- row close -->
        <div class="col-md-12 col-lg-8 col-xl-8">
            <div class="card card-table-two">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-1">Vos revenus les plus récents</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>

                <div class="table-responsive country-table">
                    <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-lg-25p">Date</th>
                                <th class="wd-lg-25p tx-right">
                                    Nombre de produits</th>
                                <th class="wd-lg-25p tx-right">Revenus</th>
                                <th class="wd-lg-25p tx-right">
                                    Frais de livraison</th>
                                <th class="wd-lg-25p tx-right">
                                    Devise</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)


                                <tr>
                                    
                                    <td  ><a href="{{ url('InvoicesDetails') }}/{{ $invoice->id }}">{{ $invoice->invoice_date }}</a></td>
                                    <td class="tx-right tx-medium tx-inverse">
                                        @php
                                            $i = 0;
                                        @endphp

                                        @foreach ($invoice->details as $item)
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                        {{ $i }}
                                    </td>
                                    <td class="tx-right tx-medium tx-inverse">{{ $invoice->sub_total }}</td>
                                    <td class="tx-right tx-medium tx-danger">{{ $invoice->shipping }}</td>
                                    <td class="tx-right tx-medium tx-inverse">{{ $invoice->devise }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
@endsection
