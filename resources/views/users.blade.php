@extends('layouts.app')
@section('content')
    <div class="page-content">


        <div class="page-title">
            <h3 class="mb-3 fw-normal">Users</h3>
        </div>

        <section class="content_list">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="allUsersTab" data-bs-toggle="tab"
                                data-bs-target="#allUser-tab-pane" type="button" role="tab"
                                aria-controls="allUser-tab-pane" aria-selected="true">All Users</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="liveStreamers-tab" data-bs-toggle="tab"
                                data-bs-target="#liveStreamers-tab-pane" type="button" role="tab"
                                aria-controls="liveStreamers-tab-pane" aria-selected="false">Live Streamers</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="fakeUser-tab" data-bs-toggle="tab"
                                data-bs-target="#fakeUser-tab-pane" type="button" role="tab"
                                aria-controls="fakeUser-tab-pane" aria-selected="false">Fake Users</button>
                        </li>
                    </ul>
                    <div class="">
                        <a href="addFakeUserView" class="btn theme-bg text-light px-4 py-2">
                            Add Fake User
                        </a>
                        {{-- <button type="button" class="btn theme-bg text-light px-4 py-2" data-bs-toggle="modal"
                            data-bs-target="#addFakeUserModal">
                            Add Fake User
                        </button> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane show active" id="allUser-tab-pane" role="tabpanel" tabindex="0">
                            <table class="table table-striped" id="allUserTable">
                                <thead>
                                    <tr>
                                        <th width="100px">User Image</th>
                                        <th> Identity</th>
                                        <th> Full Name </th>
                                        <th class="live_stream_th"> Live Stream Eligible </th>
                                        <th> Age </th>
                                        <th> Gender </th>
                                        <th width="100px"> Block User </th>
                                        <th width="100px" style="text-align: right">View Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="liveStreamers-tab-pane" role="tabpanel"
                            aria-labelledby="liveStreamers-tab" tabindex="0">
                            <table class="table table-striped" id="liveStreamersTable">
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
                            </table>
                        </div>
                        <div class="tab-pane" id="fakeUser-tab-pane" role="tabpanel" aria-labelledby="fakeUser-tab"
                            tabindex="0">
                            <table class="table table-striped" id="fakeUsersTable">
                                <thead>
                                    <tr>
                                        <th width="100px">User Image</th>
                                        <th> Identity</th>
                                        <th> Full Name </th>
                                        <th> Password </th>
                                        <th> Age </th>
                                        <th> Gender </th>
                                        <th width="100px"> Block User </th>
                                        <th width="100px" style="text-align: right">View Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    {{-- addFakeUserModal --}}
    {{-- <div class="modal fade" id="addContentModal" tabindex="-1" aria-labelledby="addContentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="addContentModalLabel">Add New Content</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
          
            </div>
        </div>
    </div> --}}


    @section('scripts')
     <script src="{{ asset('assets/js/users.js') }}"></script>
        <script>

            // image Preview JS
            var loadFile = function(event) {
                var output = document.getElementById('imagePreview');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src)
                }
            };
        </script>
    @endsection
@endsection
