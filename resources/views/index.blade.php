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
                                        <h4 class="mt-0 font-semibold">All Users</h4>
                                        <h5 class="mt-0 font-semibold">555</h5>
                                    </div>
                                    <div class="card-bottom">
                                        <a href="{{ url('users') }}" class="btn theme-bg text-white border-0 px-3 mt-2">View More</a>
                                    </div>
                                </div>
                                <div class="card-right">
                                    <div class="card-right-icon theme-bg d-inline-block p-3 text-white rounded-circle">
                                        <i data-feather="users"></i>
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