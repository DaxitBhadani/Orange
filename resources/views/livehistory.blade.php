@extends('layouts.app')
@section('content')
    <div class="page-content">

        <div class="page-title">
            <h3 class="mb-3 fw-normal">Live History</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="liveHistoryTable">
                    <thead>
                        <tr>
                            <th width="120px">User Image</th>
                            <th> Name </th>
                            <th> Started At </th>
                            <th> Streamed For </th>
                            <th> Coins Collected </th>
                            <th style="width: 200px !important;">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@section('scripts')
    <script src="{{ asset('assets/js/livehistory.js') }}"></script>
@endsection

@endsection
