@extends('layouts.master')
@section('css')
 <!--- Internal Select2 css-->
 <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
 <!---Internal Fileupload css-->
 <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
 <!---Internal Fancy uploader css-->
 <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
 <!--Internal Sumoselect css-->
 <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect.css') }}">
 <!--Internal  TelephoneInput css-->
 <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput.css') }}">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Factures</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Etat de Paiement</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('Status_Update', ['id' => $invoice->id]) }}" method="post">
                                    {{ csrf_field() }}

                                    <div class="col">
                                        <label for="inputName" class="control-label">Numéro de Facture : </label>
                                        <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                        <input type="text" class="form-control" id="inputName" name="invoice_no"
                                        value="{{ $invoice->invoice_no }}" required
                                            readonly>
                                    </div>
        
                                    <div class="col">
                                        <label>Date de Facture :</label>
                                        <input class="form-control fc-datepicker" name="invoice_Date" 
                                            type="text" value="{{ $invoice->invoice_Date }}" required readonly>
                                    </div>
                                    
                                    <div class="col">
                                        <label>Client :</label>
                                        <input class="form-control " name="customer_name" 
                                            type="text" value="{{ $invoice->customer_name }}" required readonly>
                                    </div>
            
                                    <div class="col">
                                        <label for="exampleTextarea">Etat de  paiement :</label>
                                        <select class="form-control" id="Status" name="Status" required>
                                            <option selected="true" disabled="disabled">--Sélectionnez l'état du paiement--</option>
                                          
                                            <option value="Partiellement payé">Partiellement payé</option>
                                            <option value="Totalement payé">Totalement payé</option>
                                        
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label>Date de Paiement</label>
                                       
                                            <input class="form-control fc-datepicker" data-date-format="dd-mm-yyyy" name="Payment_Date"
                                            id="Payment_Date" placeholder="DD-MM-YYYY" type="text" value="{{ date('d-m-Y') }}" required>
                                    </div>
                                    <br><br>
            
            
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success">Changer l'etat de paiment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
  <!-- Internal Select2 js-->
  <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
  <!--Internal Fileuploads js-->
  <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
  <!--Internal Fancy uploader js-->
  <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
  <!--Internal  Form-elements js-->
  <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
  <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
  <!--Internal Sumoselect js-->
  <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
  <!--Internal  Datepicker js -->
  <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
  <!--Internal  jquery.maskedinput js -->
  <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
  <!--Internal  spectrum-colorpicker js -->
  <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
  <!-- Internal form-elements js -->
  <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

@endsection