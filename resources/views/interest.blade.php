@extends('layouts.app')
@section('content')
    <div class="page-content">

        <div class="page-title mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="mb-0 fw-normal">Interest</h3>

                <button type="button" class="btn theme-bg text-white" data-bs-toggle="modal" data-bs-target="#interestModal">
                    Add Interest
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="interestTable">
                    <thead>
                        <tr>
                            <th style="width: 300px !important;"> Title </th>
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
    <div class="modal fade" id="interestModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Interest</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addInterestForm" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="interest" required="">
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
    <div class="modal fade" id="editInterestModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Interest</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editInterestForm" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="interestID" id="interestID">
                        <div class="form-group">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="editInterest" required="">
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
    <script src="{{ asset('assets/js/interest.js') }}"></script>

   
@endsection

@endsection
