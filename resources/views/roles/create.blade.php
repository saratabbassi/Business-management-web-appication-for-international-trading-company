@extends('layouts.master')
@section('css')
    <!--Internal  Font Awesome -->
    <link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!--Internal  treeview -->
    <link href="{{ URL::asset('assets/plugins/treeview/treeview-rtl.css') }}" rel="stylesheet" type="text/css" />
@section('title')
    Ajouter Permission
@stop

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Permissions</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Ajouter un Type d'employée
            </span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Erreur</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif




{!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
<!-- row -->
<div class="row">
    <div class="col-md-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <p>Type :</p>
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- col -->
                    <div class="col">
                      <div>
                           <a href="#">Permissions : </a>
                        </div>
                         <br>
                         <br>
                          
                            @foreach ($permission as $value)
                           <div>
                                <label
                                    style="font-size: 16px;">{{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                                   {{ $value->name }} </label>
                                </div>

                            @endforeach
                            </li>

                      
                        </li>
                        </ul>
                    </div>
                    <!-- /col -->
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <a href="{{ route('home') }}" class="btn btn-danger waves-effect waves-light ">Annuler</a>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>

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

{!! Form::close() !!}
@endsection
@section('js')
<!-- Internal Treeview js -->
<script src="{{ URL::asset('assets/plugins/treeview/treeview.js') }}"></script>
@endsection
