@extends('layouts.app')
@section('content')
    <div class="page-content">

        <div class="page-title mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="mb-0 fw-normal">Daimond Pack</h3>

                <button type="button" class="btn theme-bg text-white" data-bs-toggle="modal" data-bs-target="#diamondPackModal">
                    Add Pack
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="diamondPackTable">
                    <thead>
                        <tr>
                            <th>Diamond Amount</th>
                            <th> Price </th>
                            <th> Android Product id </th>
                            <th> iOS Product id </th>
                            <th style="width: 200px !important;"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="diamondPackModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Pack</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="diamondPackForm" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="diamond_amount" class="form-label">Diamond Amount</label>
                            <input type="number" class="form-control" name="diamond_amount">
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-label"> Price </label>
                            <input type="number" class="form-control" name="price">
                        </div>
                        <div class="form-group">
                            <label for="android_product_id" class="form-label"> Android Product id </label>
                            <input type="text" class="form-control" name="android_product_id">
                        </div>
                        <div class="form-group">
                            <label for="ios_product_id" class="form-label"> iOS Product id </label>
                            <input type="text" class="form-control" name="ios_product_id">
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
       <div class="modal fade" id="editDiamondPackModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pack</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editDiamondPackForm" method="POST">
                    <input type="hidden" name="diamondPackID" id="diamondPackID" value="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="diamond_amount" class="form-label">Diamond Amount</label>
                            <input type="number" class="form-control" name="diamond_amount" id="diamond_amount">
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-label"> Price </label>
                            <input type="number" class="form-control" name="price" id="price">
                        </div>
                        <div class="form-group">
                            <label for="android_product_id" class="form-label"> Android Product id </label>
                            <input type="text" class="form-control" name="android_product_id" id="android_product_id">
                        </div>
                        <div class="form-group">
                            <label for="ios_product_id" class="form-label"> iOS Product id </label>
                            <input type="text" class="form-control" name="ios_product_id" id="ios_product_id">
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
    <script src="{{ asset('assets/js/diamondPack.js') }}"></script>
@endsection

@endsection
