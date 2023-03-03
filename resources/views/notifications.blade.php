@extends('layouts.app')
@section('content')
    <div class="page-content">

        <div class="page-title mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="mb-0 fw-normal">Notification</h3>
                <button type="button" class="btn theme-bg text-white" data-bs-toggle="modal" data-bs-target="#notificationModal">
                    Send Notification
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="notificationTable">
                    <thead>
                        <tr>
                            <th style="width: 300px !important;"> Title </th>
                            <th> Message </th>
                            <th style="width: 300px !important;"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>


    </div>



    <!-- Modal -->
    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Send Notification</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="sendNotificationForm" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>
                        <div class="form-group">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" id="message" cols="30" rows="4" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-items-center justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary theme-bg text-white">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editNotificationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Notification</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editNotificationForm" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="notificationId" id="notificationId">
                        <div class="form-group">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="editTitle" required>
                        </div>
                        <div class="form-group">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" id="editMessage" cols="30" rows="4" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-items-center justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary theme-bg text-white">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

 


@section('scripts')
    <script src="{{ asset('assets/js/notification.js') }}"></script>
@endsection

@endsection
