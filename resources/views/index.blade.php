@extends('layouts.app')
@section('content')
   
    <div class="page-content dashboard-page">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                        <div class="card">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-left">
                                    <div class="card-top">
                                        <div class="card-right-icon theme-bg d-inline-block p-3 text-white rounded-circle">
                                            <i data-feather="users"></i>
                                        </div>
                                        <h4 class="mt-0 fw-500">All Users</h4>
                                        <h4 class="m-0 font-semibold">{{ $users }}</h4>
                                    </div>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                        <div class="card">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-left">
                                    <div class="card-top">
                                        <div class="card-right-icon theme-bg d-inline-block p-3 text-white rounded-circle">
                                            <i data-feather="disc"></i>
                                        </div>
                                        <h4 class="mt-0 fw-500">Livestream Enabled Users</h4>
                                        <h4 class="m-0 font-semibold">{{ $livestream }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>
    </div>
@endsection