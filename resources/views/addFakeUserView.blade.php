@extends('layouts.app')
@section('content')
    <div class="page-content">
       
        <div class="card">
            <div class="card-header page-title">
                <h3 class="mb-0 fw-normal">Add Fake User</h3>
            </div>
            
            <form id="addFakeUserForm" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="row align-items-end">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1">
                            <div class="form-group">
                                <div class="upload__box">
                                    <div class="upload__btn-box">
                                        <div class="upload__img-wrap"></div>
                                      <label class="upload__btn">
                                        <p class="m-0">Add Image</p>
                                        <input type="file" multiple id="gallery-photo-add"  data-max_length="20" name="images[]" accept="image/*" id="addImage" class="addImage upload__inputfile form-control" required="">
                                      </label>
                                    </div>
                                  </div>
                            </div>
                        </div>
                        {{-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="addImage" class="form-label">
                                    Add Image
                                </label>
                                <img id="imagePreview" class="custom_img ms-2 mb-3" height="75" width="75"
                                    src="{{ asset('assets/img/user.svg') }}">
                                <input type="file" name="images[]" accept="image/*" onchange="loadFile(event)"
                                    id="addImage" class="addImage form-control" required="" multiple>
                            </div>
                        </div> --}}
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" required="">
                            </div>
                        </div>
                        {{-- <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" class="form-control" name="password" required="">
                            </div>
                        </div> --}}
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="lives_at" class="form-label"> Lives At </label>
                                <input type="text" class="form-control" name="lives_at" required="">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="age" class="form-label"> Age </label>
                                <input type="number" class="form-control" name="age" required="">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="gender" class="form-label"> Gender </label>
                                <select name="gender" id="gender" class="form-control" required="">
                                    <option value="" disabled="" selected>Select Gender</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="about" class="form-label">About</label>
                                <textarea name="about" rows="2" class="form-control" required=""></textarea>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea name="bio" rows="2" class="form-control" required=""></textarea>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="youtube" class="form-label">YouTube</label>
                                <input type="text" name="youtube" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="text" name="facebook" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="text" name="instagram" class="form-control" required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary px-4 py-2" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn theme-bg text-light px-4 py-2">Submit</button>
                </div>
            </form>
        </div>
    </div>

@section('scripts')
    <script src="{{ asset('assets/js/users.js') }}"></script>
    <script>
  

  jQuery(document).ready(function () {
  ImgUpload();
});

function ImgUpload() {
  var imgWrap = "";
  var imgArray = [];

  $('.upload__inputfile').each(function () {
    $(this).on('change', function (e) {
      imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
      var maxLength = $(this).attr('data-max_length');

      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);
      var iterator = 0;
      filesArr.forEach(function (f, index) {

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
            reader.onload = function (e) {
              var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
              imgWrap.append(html);
              iterator++;
            }
            reader.readAsDataURL(f);
          }
        }
      });
    });
  });

  $('body').on('click', ".upload__img-close", function (e) {
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
