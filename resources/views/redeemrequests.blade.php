@extends('layouts.app')
@section('content')
    <div class="page-content">

        <div class="page-title">
            <h3 class="mb-3 fw-normal">Redeem Requests</h3>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pendingRedeemTab" data-bs-toggle="tab"
                            data-bs-target="#pendingRedeem-pane" type="button" role="tab"
                            aria-controls="pendingRedeem-panel" aria-selected="true">Pending Redeem</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="completedRedeem-tab" data-bs-toggle="tab"
                            data-bs-target="#completedRedeem-tab-pane" type="button" role="tab"
                            aria-controls="completedRedeem-tab-pane" aria-selected="false">Completed Redeem</button>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane show active" id="pendingRedeem-pane" role="tabpanel" aria-labelledby="movie-tab"
                        tabindex="0">
                        <table class="table table-striped" id="pendingRedeemTable">
                            <thead>
                                <tr>
                                    <th width="120px">User Image</th>
                                    <th> Name </th>
                                    <th> Request ID </th>
                                    <th> Coin Amount </th>
                                    <th> Payable Amount </th>
                                    <th> Payment Gateway </th>
                                    <th style="width: 200px !important;"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="completedRedeem-tab-pane" role="tabpanel" aria-labelledby="liveStreamers-tab"
                        tabindex="0">
                        {{-- <table class="table table-striped" id="liveStreamersTable">
                            <thead>
                                <tr>
                                    <th width="100px">User Image</th>
                                    <th> Identity</th>
                                    <th> Full Name </th>
                                    <th class="live_stream_th"> Live Stream Eligible </th>
                                    <th> Age </th>
                                    <th> Gender </th>
                                    <th width="100px"> Block User </th>
                                    <th style="text-align: right; width: 100px !important;">View Details</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table> --}}
                    </div>

                </div>

            </div>
        </div>
    </div>


@section('scripts')
    <script src="{{ asset('assets/js/redeemRequest.js') }}"></script>
@endsection

@endsection
