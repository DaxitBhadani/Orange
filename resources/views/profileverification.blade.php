@extends('layouts.app')
@section('content')
    <div class="page-content">

        <div class="page-title mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="mb-0 fw-normal">Profile Verification</h3>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="profileVerificationTable">
                    <thead>
                        <tr>
                            <th style="width: 150px !important;"> User image </th>
                            <th style="width: 120px !important;"> Selfie </th>
                            <th style="width: 120px !important;"> Document </th>
                            <th> Document Type </th>
                            <th> Full Name </th>
                            <th> Identity </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



 


@section('scripts')
    <script src="{{ asset('assets/js/profileverification.js') }}"></script>
@endsection

@endsection
