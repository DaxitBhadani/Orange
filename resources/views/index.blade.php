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
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                        <div class="card">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-left">
                                    <div class="card-top">
                                        <div class="card-right-icon theme-bg d-inline-block p-3 text-white rounded-circle">
                                            <i data-feather="slash"></i>
                                        </div>
                                        <h4 class="mt-0 fw-500">Blocked Users</h4>
                                        <h4 class="m-0 font-semibold">{{ $block_user }}</h4>
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
                                            <i data-feather="camera"></i>
                                        </div>
                                        <h4 class="mt-0 fw-500">Live Applications</h4>
                                        <h4 class="m-0 font-semibold">{{ $liveApplication }}</h4>
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
                                            <i data-feather="book-open"></i>
                                        </div>
                                        <h4 class="mt-0 fw-500">Pending Redeems</h4>
                                        <h4 class="m-0 font-semibold">{{ $pendingRedeem }}</h4>
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
                                            <i data-feather="dollar-sign"></i>
                                        </div>
                                        <h4 class="mt-0 fw-500">Completed Redeems</h4>
                                        <h4 class="m-0 font-semibold">{{ $completedRedeem }}</h4>
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
                                            <i data-feather="package"></i>
                                        </div>
                                        <h4 class="mt-0 fw-500">Diamond Packs</h4>
                                        <h4 class="m-0 font-semibold">{{ $diamondPacks }}</h4>
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
                                            <i data-feather="gift"></i>
                                        </div>
                                        <h4 class="mt-0 fw-500">Gifts</h4>
                                        <h4 class="m-0 font-semibold">{{ $gifts }}</h4>
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
                                            <i data-feather="check-circle"></i>
                                        </div>
                                        <h4 class="mt-0 fw-500">Verification Requests</h4>
                                        <h4 class="m-0 font-semibold">{{ $verificationRequests }}</h4>
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
                                            <i data-feather="heart"></i>
                                        </div>
                                        <h4 class="mt-0 fw-500">Interest</h4>
                                        <h4 class="m-0 font-semibold">{{ $interest }}</h4>
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
                                            <i data-feather="clipboard"></i>
                                        </div>
                                        <h4 class="mt-0 fw-500">Report</h4>
                                        <h4 class="m-0 font-semibold">{{ $report }}</h4>
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