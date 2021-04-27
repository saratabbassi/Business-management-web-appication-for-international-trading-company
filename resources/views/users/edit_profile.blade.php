@extends('layouts.master')
@section('css')
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Employée</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Modifier
                    le profil</span>
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
    <form enctype="multipart/form-data" action="{!!route('profile_update')!!}" method="POST">
        <div class="row row-sm">
            @csrf
         
            <!-- Col -->

            <div class="col-lg-4">
                <div class="card mg-b-20">
                    <div class="card-body">
                        <div class="pl-0">
                            <div class="main-profile-overview">
                            
                                <div class="main-img-user profile-user">
                                    <img src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="">


                                    <a id="get_file" class="fas fa-camera profile-edit" href="JavaScript:void(0);"> <input
                                            type="file" name="avatar" id="my_file" style="display: none"> </a>

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </div>
                                <div class="d-flex justify-content-between mg-b-20">
                                    <div>
                                        <h5 class="main-profile-name">{{ Auth::user()->name }}</h5>
                                        <p class="main-profile-name-text">
                                            {{ Auth::user()->email }}</p>
                                    </div>
                                </div>


                                <hr class="mg-y-30">
                                <label class="main-content-label tx-13 mg-b-20">Social</label>
                                <div class="main-profile-social-list">
                                    <div class="media">
                                        <div class="media-icon bg-dark text-white">
                                            <i class="icon ion-logo-github"></i>
                                        </div>
                                        <div class="media-body">
                                            <span>Github</span> <a href="{{ Auth::user()->github }}">{{ Auth::user()->github }}</a>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-icon bg-primary text-white">
                                            <i class="icon ion-logo-facebook"></i>
                                        </div>
                                        <div class="media-body">
                                            <span>Facebook</span> <a href="{{ Auth::user()->facebook }}">{{ Auth::user()->facebook }}</a>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-icon bg-info text-white">
                                            <i class="icon ion-logo-linkedin"></i>
                                        </div>
                                        <div class="media-body">
                                            <span>Linkedin</span> <a href="{{ Auth::user()->linkedin }}">{{ Auth::user()->linkedin }}</a>
                                        </div>
                                    </div>

                                </div>




                            </div><!-- main-profile-overview -->
                        </div>
                    </div>
                </div>
                <div class="card mg-b-20">
                    <div class="card-body">
                        <div class="main-content-label tx-13 mg-b-25">
                            Contact
                        </div>
                        <div class="main-profile-contact-list">
                            <div class="media">
                                <div class="media-icon bg-primary-transparent text-primary">
                                    <i class="icon ion-md-phone-portrait"></i>
                                </div>
                                <div class="media-body">
                                    <span>Numéro de Téléphone</span>
                                    <div>
                                        {{ Auth::user()->phone }}
                                    </div>
                                </div>
                            </div>

                            <div class="media">
                                <div class="media-icon bg-info-transparent text-info">
                                    <i class="icon ion-md-locate"></i>
                                </div>
                                <div class="media-body">
                                    <span>
                                        Adresse actuelle</span>
                                    <div>
                                        {{ Auth::user()->adress }}
                                    </div>
                                </div>
                            </div>
                        </div><!-- main-profile-contact-list -->
                    </div>
                </div>
            </div>

            <!-- Col -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4 main-content-label">
                            Renseignements personnels</div>


                        <div class="mb-4 main-content-label"></div>

                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Nom & Prénom</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Nom & Prénom" id="name" name="name"
                                        value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                        </div>



                        <div class="mb-4 main-content-label">Contact </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Email<i>(
                                            obligatoire)</i></label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Email" value="  {{ Auth::user()->email }}" id="email" name="email">
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Numéro de Téléphone</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Numéro de Téléphone" id="phone" name="phone"
                                        value="  {{ Auth::user()->phone }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Addresse</label>
                                </div>
                                <div class="col-md-9">
                                    <textarea class="form-control"  rows="2"
                                        placeholder="Addresse" id="adress" name="adress">  {{ Auth::user()->adress }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 main-content-label">
                            Informations sociales</div>

                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Facebook</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Facebook" id="facebook" name="facebook"
                                        value="{{ Auth::user()->facebook }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Linkedin</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="linkedin" id="linkedin" name="linkedin"
                                        value="  {{ Auth::user()->linkedin }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Github</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="github" value="  {{ Auth::user()->github }}" id="github" name="github">
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary waves-effect waves-light ">Modifier le Profile</button>
                    </div>

                </div>
            </div>

            <!-- /Col -->
        </div>
    </form>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <script>
        document.getElementById('get_file').onclick = function() {
            document.getElementById('my_file').click();
        };

    </script>
@endsection
