@extends('layouts.app')
@section('content')
    <div class="page-content">

        <div class="page-title mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="mb-0 fw-normal">Reports</h3>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="reportTable">
                    <thead>
                        <tr>
                            <th width="120px">User Image</th>
                            <th> Identity </th>
                            <th> Full Name </th>
                            <th> Reason </th>
                            <th> Description </th>
                            <th style="width: 200px !important;"> Block User </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>


    </div>







@section('scripts')
    <script src="{{ asset('assets/js/report.js') }}"></script>
@endsection

@endsection
