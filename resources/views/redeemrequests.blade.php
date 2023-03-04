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
                    <div class="tab-pane show active" id="pendingRedeem-pane" role="tabpanel" tabindex="0">
                        <table class="table table-striped" id="pendingRedeemTable">
                            <thead>
                                <tr>
                                    <th width="120px">User Image</th>
                                    <th> Name </th>
                                    <th> Request ID </th>
                                    <th> Coin Amount </th>
                                    <th> Payable Amount </th>
                                    <th> Payment Gateway </th>
                                    <th style="width: 250px !important;"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="completedRedeem-tab-pane" role="tabpanel" tabindex="0">
                        <table class="table table-striped" id="completedRedeemTable">
                            <thead>
                                <tr>
                                    <th width="120px">User Image</th>
                                    <th> Name </th>
                                    <th> Request ID </th>
                                    <th> Coin Amount </th>
                                    <th> Amount Paid </th>
                                    <th> Payment Gateway </th>
                                    <th style="width: 250px !important;"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="redeemCompleteModal" tabindex="-1" aria-labelledby="redeemCompleteLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="redeemCompleteLabel"> </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="redeemCompleteFormHeader">
                        <div class="d-flex align-items-center mb-3">
                            <div class="userimage">
                                <img src="" alt="" id="userimage"
                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 30px; box-shadow: 0px 10px 10px -10px #8f8f8f;">
                            </div>
                            <div class="username ms-3" id="username"></div>
                        </div>
                    </div>

                    <form id="redeemCompleteForm" method="post">
                        <input type="hidden" name="redeemRequestId" id="redeemRequestId">
                        <input type="hidden" name="is_completed" id="is_completed" value="1">

                        <div class="form-group">
                            <label for="coin_amount" class="form-label">Coin Amount</label>
                            <input type="text" class="form-control" name="coin_amount" id="coin_amount" readonly>
                        </div>
                        <div class="form-group">
                            <label for="amount paid" class="form-label">Amount Paid</label>
                            <input type="number" step=any class="form-control" name="amount_paid" id="amount_paid"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="payment_gateway" class="form-label">Payment gateway</label>
                            <input type="text" class="form-control" name="payment_gateway" id="payment_gateway"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="account_detail" class="form-label">Account Detail</label>
                            <textarea name="account_detail" id="account_detail" cols="30" rows="3" class="form-control" readonly></textarea>
                        </div>
                        <button type="submit" class="m-3 mx-0 btn unblock px-4 text-white complete">Complete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="redeemCompleteViewModal" tabindex="-1" aria-labelledby="redeemCompleteLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="redeemCompleteLabel1"> </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="redeemCompleteFormHeader">
                        <div class="d-flex align-items-center mb-3">
                            <div class="userimage">
                                <img src="" alt="" id="userimage1"
                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 30px; box-shadow: 0px 10px 10px -10px #8f8f8f;">
                            </div>
                            <div class="username ms-3" id="username1"></div>
                        </div>
                    </div>
                    <form id="redeemCompleteForm" method="post">
                        <input type="hidden" name="redeemRequestId" id="redeemRequestId1">
                        <input type="hidden" name="is_completed" id="is_completed1" value="1">

                        <div class="form-group">
                            <label for="coin_amount" class="form-label">Coin Amount</label>
                            <input type="text" class="form-control" name="coin_amount" id="coin_amount1" readonly>
                        </div>
                        <div class="form-group">
                            <label for="amount paid" class="form-label">Amount Paid</label>
                            <input type="number" step=any class="form-control" name="amount_paid" id="amount_paid1"
                                readonly required>
                        </div>
                        <div class="form-group">
                            <label for="payment_gateway" class="form-label">Payment gateway</label>
                            <input type="text" class="form-control" name="payment_gateway" id="payment_gateway1"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="account_detail" class="form-label">Account Detail</label>
                            <textarea name="account_detail" id="account_detail1" cols="30" rows="3" class="form-control" readonly></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@section('scripts')
    <script src="{{ asset('assets/js/redeemRequest.js') }}"></script>
@endsection

@endsection
