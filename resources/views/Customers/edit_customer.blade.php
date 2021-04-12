@extends('layouts.master')
@section('title')
Ajouter Clients
@endsection
@section('css')
<!--- Internal Select2 css-->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between" >
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Clients</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Ajouter </span>
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
@if (session()->has('edit'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('edit') }}</strong>
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
								
								<br>
								<div id="wizard1">
									<h3>Informations de client</h3>
									<section>
										<form action="{{url ('customers/update') }}" method="post" enctype="multipart/form-data"
										autocomplete="off">
                                        {{ method_field('patch') }}
										{{ csrf_field() }}
										<div class="control-group form-group">
											<label class="form-label">Name</label>
                                            <input type="hidden" name="customer_id" value="{{ $customers->id }}">
											<input type="text"  id="inputName" name="customer_name" class="form-control required"  value="{{$customers->customer_name}} " placeholder="Name">
										</div>
										<div class="control-group form-group">
											<label class="form-label">Email</label>
											<input type="email"  id="customer_email" name="customer_email" class="form-control " value="{{$customers->customer_email}} " placeholder=" Addresse mail">
										</div>
										<div class="control-group form-group">
											<label class="form-label">Numéro de téléphone</label>
											<input type="text"  id="customer_phone" name="customer_phone"  class="form-control " value="{{$customers->customer_phone}} " placeholder=" Numéro de téléphone">
										</div>
										
										<div class="control-group form-group mb-0">
											<label class="form-label">Adresse</label>
											<input type="text" id="customer_adress" name="customer_adress" class="form-control required" value="{{$customers->customer_adress}} " placeholder="Addresse">
										</div>
									
									
									
									<br>
									
									<div class="d-flex justify-content-center">
										<button type="submit" class="btn btn-primary">Modifier</button>
									</div>
								</section>
							</form>
											
									
								</div>
							</div>
						</div>
					</div>
					
				<!-- row -->
				
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Select2 js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Jquery.steps js -->

<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!--Internal  Form-wizard js -->
<script src="{{URL::asset('assets/js/form-wizard.js')}}"></script>
@endsection