@extends('layouts.app')
@section('content')
    <div class="page-content">

        <div class="card">
            <form id="updateUserDetailForm" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="page-title d-flex align-items-center">
                        <h3 class="mb-0 fw-500 theme-color"> {{ $user->name }} </h3>
                        @if ($user->live_stream == 2)
                            <div class="ms-3">
                                <span class="badge canGoLive"> Can Go Live </span>
                            </div>
                        @endif
                        @if ($user->user_type == 0)
                            <div class="ms-3">
                                <span class="badge fakeUser"> Fake User </span>
                            </div>
                        @else
                            <div class="ms-3">
                                <span class="badge live_stream_btn"> Real User </span>
                            </div>
                        @endif
                    </div>
                    <div class="card-header-right d-flex align-items-center">
                        <div class="gender-badge">
                            @if ($user->gender == 1)
                                <span class="ms-3 badge theme-bg"> Male </span>
                            @else
                                <span class="ms-3 badge theme-bg"> Female </span>
                            @endif
                        </div>
                        <div class="block-badge">
                            @if ($user->block_user == 0)
                                <label class="block_switch ms-2">
                                    <input type="checkbox" name="block_user" rel="{{ $user->id }}"
                                        value="{{ $user->block_user }}" id="block_user" class="block_user">
                                    <span class="btn text-white sliders badge block">
                                        Block
                                    </span>
                                </label>
                            @else
                                <label class="block_switch ms-2">
                                    <input type="checkbox" name="block_user" rel="{{ $user->id }}"
                                        value="{{ $user->block_user }}" id="block_user" class="block_user" checked>
                                    <span class="btn text-white sliders badge unblock">
                                        Unblock
                                    </span>
                                </label>
                            @endif
                        </div>
                        <div class="liveStream-badge">
                            @if ($user->live_stream == 0)
                                <label class="block_switch ms-2">
                                    <input type="checkbox" name="live_stream" rel="{{ $user->id }}"
                                        value="{{ $user->live_stream }}" id="" class="live_stream_btn">
                                    <span class="btn text-white sliders badge unblock">
                                        Allow Live-stream
                                    </span>
                                </label>
                            @else
                                <label class="block_switch ms-2">
                                    <input type="checkbox" name="live_stream" rel="{{ $user->id }}"
                                        value="{{ $user->live_stream }}" id="" class="live_stream_btn" checked>
                                    <span class="btn text-white sliders badge block">
                                        Restrict Live-Stream
                                    </span>
                                </label>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-items-end">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1">
                            <div class="form-group">
                                <div class="upload__box">
                                    <div class="upload__btn-box">
                                        <div class="upload__img-wrap">
                                            @foreach ($user_images as $user_image)
                                                <div class="upload__img-box">
                                                    <div class="img-bg"
                                                        style="background-image: url(../upload/user/{{ $user_image->user_image }});">
                                                        <div class="upload__img-close removeImage" rel="{{ $user_image->id }}"></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <label class="upload__btn">
                                            <p class="m-0">Add Image</p>
                                            <input type="file" multiple id="gallery-photo-add" data-max_length="20"
                                                name="images[]" accept="image/*" id="addImage"
                                                class="addImage upload__inputfile form-control" >
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="identity" class="form-label">Identity</label>
                                <input type="text" class="form-control" name="identity" required=""
                                    value="{{ $user->identity }}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" class="form-control" name="password" required=""
                                    value="{{ $user->password }}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" required=""
                                    value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="age" class="form-label"> Age </label>
                                <input type="number" class="form-control" name="age" value="{{ $user->age }}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="youtube" class="form-label">YouTube</label>
                                <input type="text" name="youtube" class="form-control" value="{{ $user->youtube }}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="text" name="facebook" class="form-control" value="{{ $user->facebook }}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="text" name="instagram" class="form-control" value="{{ $user->instagram }}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="lives_at" class="form-label"> Lives At </label>
                                <input type="text" class="form-control" name="lives_at" value="{{ $user->lives_at }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="about" class="form-label">About</label>
                                <textarea name="about" rows="2" class="form-control" value="{{ $user->about }}">{{ $user->about }}</textarea>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea name="bio" rows="2" class="form-control" value="{{ $user->bio }}">{{ $user->bio }}</textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-start">
                    {{-- <button type="button" class="btn btn-secondary px-4 py-2" data-bs-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn theme-bg text-light px-4 py-2 fw-500" style="width: 150px;">Submit</button>
                </div>
            </form>
        </div>

    </div>

@section('scripts')
    <script src="{{ asset('assets/js/users.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            ImgUpload();
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').each(function() {
                $(this).on('change', function(e) {
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');

                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function(f, index) {

                        if (!f.type.match('image.*')) {
                            return;
                        }

                        if (imgArray.length > maxLength) {
                            return false
                        } else {
                            var len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) {
                                return false;
                            } else {
                                imgArray.push(f);

                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    var html =
                                        "<div class='upload__img-box'><div style='background-image: url(" +
                                        e.target.result + ")' data-number='" + $(
                                            ".upload__img-close").length + "' data-file='" + f
                                        .name +
                                        "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                    imgWrap.append(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });

            $('body').on('click', ".upload__img-close", function(e) {
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
            });
        }
    </script>
@endsection

@endsection
