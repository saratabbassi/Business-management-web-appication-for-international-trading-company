@extends('layouts.master')
@section('title')
    Clients
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between" >
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Clients</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Liste</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
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
				@endif
			</div>
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
                            <div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									@can('Ajouter Client')
									
									<a href="customers/create" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
										class="fas fa-plus"></i> &nbsp;Ajouter Client</a>

										@endcan
									
								</div>
								
								
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">#</th>
												<th class="wd-15p border-bottom-0">Nom</th>
												<th class="wd-15p border-bottom-0">Email</th>
												<th class="wd-20p border-bottom-0">
                                                    Numéro de téléphone</th>
												<th class="wd-15p border-bottom-0">Adresse</th>
												
												<th class="wd-25p border-bottom-0">Operations</th>
											</tr>
										</thead>
										<tbody>
											@php
												$i=0;
											@endphp
												@foreach ($customers as $customer)
												@php
													$i++
												@endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{$customer->customer_name}}</td>
												<td>{{$customer->customer_email}}</td>
												<td>{{$customer->customer_phone}}</td>
												<td>{{$customer->customer_adress}}</td>
											
													<td>
														@can('Modifier Client')
													<a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
												   
													href="{{ url ('edit_customer')}}/{{$customer->id}}" title="Modifier"><i class="las la-pen"></i></a>
													@endcan
										   
	
										  
												
														@can('Supprimer Client')
														<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
														data-id="{{ $customer->id }}" data-customer_name="{{ $customer->customer_name }}"
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
				<h6 class="modal-title">Supprimer Client </h6><button aria-label="Close" class="close" data-dismiss="modal"
					type="button"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="customers/destroy" method="post">
				{{ method_field('delete') }}
				{{ csrf_field() }}
				<div class="modal-body">
					<p>voulez-vous supprimer le client ?</p><br>
					<input type="hidden" name="id" id="id" value="">
					<input class="form-control" name="customer_name" id="customer_name" type="text" readonly>
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
					</div>
					<!--/div-->

					
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var customer_name = button.data('customer_name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #customer_name').val(customer_name);
    })
</script>
@endsection