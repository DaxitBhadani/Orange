// diamondPackForm
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $("#notificationTable").dataTable({
        processing: true,
        serverSide: true,
        serverMethod: "post",
        aaSorting: [
            [0, "desc"]
        ],
        columnDefs: [{
            targets: [],
            orderable: false,
        },],
        ajax: {
            url: `notificationList`,
            data: function (data) {},
            error: (error) => {
                console.log(error);
            },
        },
    });

   
    $(document).on("submit", "#sendNotificationForm", function (e) {
        e.preventDefault();
        let formData = new FormData($("#sendNotificationForm")[0]);

        $.ajax({
            type: "POST",
            url: `${domainURL}sendNotification`,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 400) {
                    console.log(response.errors);
                } else if (response.status == 200) {
                    swal("Notification Added successfully", {
                        icon: "success",
                    });
                    $("#notificationTable").DataTable().ajax.reload(null, false);
                    $('#notificationModal').modal('hide');
                }
            },
        });
    }); 


    $("#notificationTable").on("click", ".edit", function (e) {
        e.preventDefault();

        var id = $(this).attr("rel");
        var title = $(this).data("title");
        var message = $(this).data("message");
    
        $("#notificationId").val(id);
        $("#editTitle").val(title);
        $("#editMessage").val(message);

        $("#editNotificationModal").modal("show");

    });


    $(document).on('submit', '#editNotificationForm', function (e) {
        e.preventDefault();
        var id = $('#notificationId').val();
        console.log(id);
        let EditformData = new FormData($('#editNotificationForm')[0]);

        $.ajax({
            type: "POST",
            url: `${domainURL}updateNotification/` + id,
            data: EditformData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == false) {
                    console.log("400");
                    console.log(response.errors);
                } else if (response.status == 404) {
                    alert(response.message);
                } else if (response.status == 200) {
                    swal({
                        title: "Notification Updated Succesfully!",
                        icon: "success",
                    });
                    $("#notificationTable").DataTable().ajax.reload(null, false);
                    $('#editNotificationModal').modal('hide');

                }
            }
        });
    });




});