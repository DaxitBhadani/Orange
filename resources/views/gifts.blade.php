@extends('layouts.app')
@section('content')
    <div class="page-content">

        <div class="page-title mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="mb-0 fw-normal">Gifts</h3>

                <button type="button" class="btn theme-bg text-white" data-bs-toggle="modal" data-bs-target="#giftModal">
                    Add Gifts
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="giftTable">
                    <thead>
                        <tr>
                            <th style="width: 100px !important;"> Image </th>
                            <th style="width: 200px !important;"> Price </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="giftModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add gift</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="giftForm" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="giftImage" class="form-label w-100">gift Image</label>
                            <img id="giftImage" class="custom_img mb-3 object-cover" height="100" width="100"
                                src="{{ asset('assets/img/gift.svg') }}" />
                            <input type="file" accept="image/*" onchange="loadFile(event)" name="image"
                                id="giftImageFile" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-label">Price (Coins)</label>
                            <input type="text" class="form-control" name="price" id="price" required="">
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-items-center justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary theme-bg text-white">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editGiftModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit gift</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editGiftForm" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="giftID" id="giftID">
                        <div class="form-group">
                            <label for="giftImage" class="form-label w-100">gift Image</label>
                            <img id="editGiftImage" class="custom_img mb-3 object-cover" height="100" width="100"
                                src="{{ asset('assets/img/gift.svg') }}" />
                            <input type="file" accept="image/*" onchange="loadFile1(event)" name="image"
                                id="giftImageFile" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-label">Price (Coins)</label>
                            <input type="text" class="form-control" name="price" id="editGiftPrice" required="">
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-items-center justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary theme-bg text-white">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@section('scripts')
    <script src="{{ asset('assets/js/giftPage.js') }}"></script>

    <script>
        var loadFile = function(event) {
            var output = document.getElementById('giftImage');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }

        };
        var loadFile1 = function(event) {
            var output = document.getElementById('editGiftImage');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
@endsection

@endsection
