@extends('layouts.app')
@section('content')
    <div class="page-content">

        <div class="page-title">
            <h3 class="mb-3 fw-normal">Live Application Detail</h3>
        </div>

        <div class="card">
            <form id="liveApplicationDetailForm" method="post">
                <div class="card-body">
                    <div class="card-heder p-0 d-flex align-items-center">
                        <h5 class="m-0 fw-500"> {{ $userData->name }} </h5>
                        @if ($userData->gender == 1)
                            <span class="badge unblock ms-3">
                                Male
                            </span>
                        @else
                            <span class="badge unblock ms-3">
                                Female
                            </span>
                        @endif
                    </div>
                    <div class="d-flex align-items-end">
                        <div class="user_image">
                            <img src="../upload/user/{{ $userImage->user_image }}" alt="" class="img-fluid">
                        </div>
                        <button type="button" class="btn theme-bg text-white fw-500 theme-btn-shadow ms-5 px-4"
                            data-bs-toggle="modal" data-bs-target="#videoModal">
                            Video Intro
                        </button>
                    </div>
                    <div class="row align-items-end mt-4">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" readonly
                                    value="{{ $userData->name }}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="identity" class="form-label">Identity</label>
                                <input type="text" class="form-control" name="identity" readonly
                                    value="{{ $userData->identity }}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="age" class="form-label"> Age </label>
                                <input type="text" class="form-control" name="age" readonly
                                    value="{{ $userData->age }}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="age" class="form-label"> language </label>
                                <input type="text" class="form-control" name="language" readonly value="{{ $liveAppData->language }}">
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="about" class="form-label">About</label>
                                <textarea name="about" rows="2" class="form-control" readonly value="{{ $userData->about }}">{{ $userData->about }}</textarea>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="text" name="instagram" class="form-control" readonly
                                    value="{{ $liveAppData->social_link }}">
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-3">
                            {{-- <button type="button"
                                class="approve_application btn unblock fw-500 py-2 me-3 text-white">Approve
                                Application</button> --}}

                                <label class="block_switch btn unblock cursor ">
                                    <input type="checkbox" name="live_stream" rel="{{$liveAppData->user_id}}" id="live_stream_status" class="approve_application">
                                    <span class="text-white fw-500 sliders">Approve Application</span>
                               </label>

                                <label class="block_switch btn block cursor ms-2">
                                     <input type="checkbox" name="live_stream" rel="{{$liveAppData->user_id}}" id="live_stream_status" class="reject_application">
                                     <span class="text-white fw-500 sliders">Reject Application</span>
                                </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="videoModalLabel">Video</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <video id="show_video" width="100%" height="500" controls="" autoplay=""
                        src="../upload/video/{{ $liveAppData->video }}" data-video="0"></video>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    <script src="{{ asset('assets/js/liveapplication.js') }}"></script>
@endsection

@endsection
