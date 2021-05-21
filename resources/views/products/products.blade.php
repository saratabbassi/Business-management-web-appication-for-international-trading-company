@extends('layouts.master')
@section('title')

    Produits
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
                <h4 class="content-title mb-0 my-auto">Produits</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
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
    <div row>
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    @can('Ajouter Produit')


                    <a href="products/create" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                            class="fas fa-plus"></i> &nbsp;Céer Produit</a>
                            @endcan

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Nom</th>
                                    <th class="border-bottom-0">Catégorie</th>
                                    <th class="border-bottom-0">Crée par</th>


                                    <th class="border-bottom-0">Details</th>

                                    <th class="border-bottom-0">Operations</th>


                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                <?php
                                use App\Products;
                                $products = Products::all();
                                ?>
                                @foreach ($products as $prod)
                                    @php
                                        $i++;
                                    @endphp

                                    <td>{{ $i }}</td>
                                    <td>{{ $prod->name }} </td>
                                    <td>{{ $prod->categorie->categorie_name }}</td>
                                    <td>{{ $prod->user }}</td>




                   
                                    <td>


                                        <a href="{{ url('productDetails') }}/{{ $prod->id }}"> <button
                                                class="btn btn-primary btn-icon"><i class="typcn typcn-document-add"></i>
                                            </button></a>




                                    </td>
                                    <td>
                                        @can('Modifier Produit')
                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                            href="{{ url('edit_product') }}/{{ $prod->id }}" title="Modifier"><i
                                                class="las la-pen"></i></a>
@endcan
@can('Supprimer Produit')


                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-id="{{ $prod->id }}" data-name="{{ $prod->name }}"
                                            data-toggle="modal" href="#modaldemo9" title="Supprimer"><i
                                                class="las la-trash"></i></a>
                                                @endcan
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
                                <h6 class="modal-title">Supprimer Produit </h6><button aria-label="Close" class="close"
                                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="products/destroy" method="post">
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
