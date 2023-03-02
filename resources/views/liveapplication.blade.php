@extends('layouts.app')
@section('content')
    <div class="page-content">

        <div class="page-title">
            <h3 class="mb-3 fw-normal">Live Application</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="liveApplicationTable">
                    <thead>
                        <tr>
                            <th width="100px">User Image</th>
                            <th> Name </th>
                            <th> Language </th>
                            <th style="text-align: right; width: 200px !important;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@section('scripts')
    <script src="{{ asset('assets/js/liveapplication.js') }}"></script>
@endsection

@endsection
