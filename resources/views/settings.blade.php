@extends('layouts.app')
@section('content')
    <div class="page-content">

        <div class="card">
            <div class="card-header page-title">
                <h3 class="mb-0 fw-normal"> App Data </h3>
            </div>
            <form id="settingForm" enctype="multipart/form-data" method="POST">
                <div class="card-body pb-0">
                    <div class="row align-items-end">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="currency" class="form-label">Currency</label>
                                <input type="text" class="form-control" name="currency" required value="{{$settings->currency}}">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="redeem_thread" class="form-label">Minimum Redeem Threshold</label>
                                <input type="number" class="form-control" name="redeem_thread" required value="{{$settings->redeem_thread}}">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="coin_rate" class="form-label">Coin Rate ($ / Coin)</label>
                                <input type="number" step=any class="form-control" name="coin_rate" required value="{{$settings->coin_rate}}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="minimum_users_live" class="form-label">Minimum Users Needed To Keep Live Continue</label>
                                <input type="number" class="form-control" name="minimum_users_live" required value="{{$settings->minimum_users_live}}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="maximum_min_users_live" class="form-label">Maximum Minutes Users Can Live Stream With < Minimum Users</label>
                                <input type="number" class="form-control" name="maximum_min_users_live" required value="{{$settings->maximum_min_users_live}}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="message_price" class="form-label">Message Price (Coins Per Message)</label>
                                <input type="text" class="form-control" name="message_price" required value="{{$settings->message_price}}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="reverse_swipe_price" class="form-label">Reverse Swipe Price (Coins Per Swipe)</label>
                                <input type="text" class="form-control" name="reverse_swipe_price" required value="{{$settings->reverse_swipe_price}}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="live_watching_price" class="form-label">Live Watching Price (Coins Per Minute)</label>
                                <input type="text" class="form-control" name="live_watching_price" required value="{{$settings->reverse_swipe_price}}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="for_dating_app" class="form-label">Dating/Livestream (Keep On for Dating App)</label>
                                @if ($settings->for_dating_app == 0)
                                <label for="for_dating_app" class="switch form-label">
                                    <input type="checkbox" name="for_dating_app" id="for_dating_app" class="for_dating_app" value="{{$settings->for_dating_app}}">
                                    <span class="slider"></span>
                                </label>
                                @else
                                <label for="for_dating_app" class="switch form-label">
                                    <input type="checkbox" name="for_dating_app" id="for_dating_app" class="for_dating_app" value="{{$settings->for_dating_app}}" checked>
                                    <span class="slider"></span>
                                </label>
                                @endif
                              
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header page-title"  style="border-top: 1px solid rgba(0, 0, 0, 0.125);">
                    <h3 class="mb-0 fw-normal"> Admob Ad Units </h3>
                </div>

                <div class="card-body pb-0">
                    <div class="row align-items-end">
                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 mb-1">
                            <div class="row align-items-end justify-content-between">
                                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 mb-1">
                                    <h5 class="mb-3">Android</h5>
                                    <div class="form-group">
                                        <label for="ad_banner_android" class="form-label">Admob Banner Ad Unit : Android</label>
                                        <input type="text" class="form-control" name="ad_banner_android" required value="{{$settings->ad_banner_android}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="ad_interstitial_android" class="form-label">Admob Interstitial Ad Unit : Android</label>
                                        <input type="text" class="form-control" name="ad_interstitial_android" required value="{{$settings->ad_interstitial_android}}">
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 mb-1">
                                    <h5 class="mb-3">iOS</h5>
                                    <div class="form-group">
                                        <label for="ad_banner_iOS" class="form-label">Admob Banner Ad Unit : iOS</label>
                                        <input type="text" class="form-control" name="ad_banner_iOS" required value="{{$settings->ad_banner_iOS}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="ad_interstitial_iOS" class="form-label">Admob Interstitial Ad Unit : iOS</label>
                                        <input type="text" class="form-control" name="ad_interstitial_iOS" required value="{{$settings->ad_interstitial_iOS}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-3 d-flex justify-content-start">
                    <button type="submit" class="btn theme-bg text-light" style="padding: 10px 70px !important;">Save</button>
                </div>
            </form>
        </div>
    </div>

@section('scripts')
    <script src="{{ asset('assets/js/setting.js') }}"></script>
@endsection

@endsection
