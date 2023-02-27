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
                        <button type="button" class="btn theme-bg text-light px-4 py-2" data-bs-toggle="modal"
                            data-bs-target="#addFakeUserModal">
                            Add Fake User
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane show active" id="allUser-tab-pane" role="tabpanel" aria-labelledby="movie-tab"
                            tabindex="0">
                            <table class="table" id="allUserTable">
                                <thead>
                                    <tr>
                                        <th width="80px">Verticle </th>
                                        <th width="80px">Horizontal</th>
                                        <th> Title </th>
                                        <th> Rating </th>
                                        <th> Release Year </th>
                                        <th> Language </th>
                                        <th> Is Featured </th>
                                        <th width="100px" style="text-align: right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="liveStreamers-tab-pane" role="tabpanel"
                            aria-labelledby="liveStreamers-tab" tabindex="0">
                            <table class="table" id="liveStreamersTable">
                                <thead>
                                    <tr>
                                        <th width="80px">Verticle </th>
                                        <th width="80px">Horizontal</th>
                                        <th> Title 111 </th>
                                        <th> Rating </th>
                                        <th> Release Year </th>
                                        <th> Language </th>
                                        <th> Is Featured </th>
                                        <th width="100px" style="text-align: right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="fakeUser-tab-pane" role="tabpanel" aria-labelledby="fakeUser-tab"
                            tabindex="0">
                            <table class="table" id="fakeUsersTable">
                                <thead>
                                    <tr>
                                        <th width="80px">Verticle</th>
                                        <th width="80px">Horizontal</th>
                                        <th> Title 2222 </th>
                                        <th> Rating </th>
                                        <th> Release Year </th>
                                        <th> Language </th>
                                        <th> Is Featured </th>
                                        <th width="100px" style="text-align: right">Action</th>
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


        {{-- Add Content Modal --}}
        <div class="modal fade" id="addFakeUserModal" tabindex="-1" aria-labelledby="addFakeUserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title fw-500" id="addFakeUserModalLabel">Add Fake User</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="add_new_content" id="addNewContentForm" method="POST">
                        <div class="modal-body">
                            <div class="row align-items-end">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="addImage" class="form-label">
                                            Add Image 
                                        </label>
                                        <img id="imagePreview" class="custom_img ms-2 mb-3" height="75" width="75" src="{{ asset('assets/img/user.svg') }}">
                                        <input type="file" accept="image/*" onchange="loadFile(event)" name="image" id="addImage" class="addImage form-control" required="">
                                    </div>
                                    
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="title" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" name="title" required="">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="lives_at" class="form-label"> Lives At </label>
                                        <input type="text" class="form-control" name="lives_at" required="">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="age" class="form-label"> Age </label>
                                        <input type="number" class="form-control" name="age" required="">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="gender" class="form-label"> Gender </label>
                                        <select name="gender" id="">
                                            <option value="0">Male</option>
                                            <option value="1">Female</option>
                                        </select>
                                    </div>
                                </div>



                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-4">
                                    <label for="desc" class="form-label">Description</label>
                                    <textarea name="desc" id="desc" rows="2" class="form-control" required=""></textarea>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-4">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-4">
                                            <label for="duration" class="form-label">Duration</label>
                                            <input type="text" name="duration" class="form-control" id="duration"
                                                aria-describedb y="duration" required="">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-4">
                                            <label for="releaseYear" class="form-label">Release Year</label>
                                            <input type="number" name="year" class="form-control" id="releaseYear"
                                                aria-describedby="releaseYear" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-4">
                                    <label for="rating" class="form-label">Rating</label>
                                    <input type="number" step=any name="rating" class="form-control" id="rating"
                                        aria-describedby="rating" required="">
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-4">
                                    <label for="trailerId" class="form-label">Youtube Trailer Id</label>
                                    <input type="text" name="trailer_id" class="form-control" id="trailerId"
                                        aria-describedby="trailerId" required="">
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="horizontalPoster" class="form-label">Horizontal Poster </label>
                                        <input type="file" accept="image/*" onchange="loadFile1(event)"
                                            name="horizontal_poster" id="horizontalPoster"
                                            class="horizontalPoster form-control" required="">
                                    </div>
                                    <img id="horizontalPosterImg" class="custom_img" height="220" width="400"
                                        src="http://localhost/_flixy/public/assets/img/image.svg">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex align-items-center justify-content-between">
                            <button type="button" class="btn btn-secondary px-4 py-2"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn theme-bg text-light px-4 py-2">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

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
