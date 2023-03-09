$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var user_type = 1;

    $("#profileVerificationTable").dataTable({
        process: true,
        serverSide: true,
        serverMethod: "post",
        aaSorting: [
            [0, "desc"]
        ],
        columnDefs: [{
            targets: [0, 1, 2, 3, 4, 5, 6],
            orderable: false,
        }],
        ajax: {
            url: `profileVerificationList`,
            data: function (data) {},
            error: (error) => {
                console.log(error);
            }
        },
    });



    $("#profileVerificationTable").on("change", ".approve_profile", function (event) {
        event.preventDefault();
        swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                // swal("Profile verification Approved", {
                //     icon: "success",
                // });
    
                if (user_type == "1") {
                    $id = $(this).attr("rel");
    
                    if ($(this).prop("checked") == true) {
                        // swal("Profile verification Approved", {
                        //     icon: "success",
                        // });
                        $value = 2;
                        console.log("Checkbox is Checked.");
                        console.log("1 == true");
                    } else {
                        // swal("Profile verification Not Approved", {
                        //     icon: "success",
                        // });
                        $value = 0;
                        console.log("Checkbox is unchecked.");
                        console.log("0 == false");
                    }
    
                    $.post(
                        `${domainURL}updateProfileVerification/` + $id,
                        {
                            id: $id,
                            is_verified: $value,
                        },
                        function (returnedData) {
                            console.log(returnedData);
                            $("#profileVerificationTable").DataTable().ajax.reload(null, false);
                        }
                    ).fail(function (error) {
                        console.log(error);
                    });
                } else {
                    iziToast.error({
                        title: "Error!",
                        message: "you are Tester",
                        position: "topRight",
                    });
                }
            } else {
                $("#profileVerificationTable").DataTable().ajax.reload(null, false);
                // swal("Record Not Rejected");
            }
        });
    });

    $("#profileVerificationTable").on("change", ".reject_profile", function (event) {
        event.preventDefault();
        swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                // swal("Profile verification Rejected", {
                //     icon: "success",
                // });
    
                if (user_type == "1") {
                    $id = $(this).attr("rel");
    
                    if ($(this).prop("checked") == true) {
                        // swal("Profile verification Rejected", {
                        //     icon: "success",
                        // });
                        $value = 0;
                        console.log("Checkbox is Checked.");
                        console.log("1 == true");
                    } else {
                        // swal("Profile verification Not Rejected", {
                        //     icon: "success",
                        // });
                        $value = 0;
                        console.log("Checkbox is unchecked.");
                        console.log("0 == false");
                    }
    
                    $.post(
                        `${domainURL}updateProfileVerification/` + $id,
                        {
                            id: $id,
                            is_verified: $value,
                        },
                        function (returnedData) {
                            console.log(returnedData);
                            $("#profileVerificationTable").DataTable().ajax.reload(null, false);
                        }
                    ).fail(function (error) {
                        console.log(error);
                    });
                } else {
                    iziToast.error({
                        title: "Error!",
                        message: "you are Tester",
                        position: "topRight",
                    });
                }
            } else {
                $("#profileVerificationTable").DataTable().ajax.reload(null, false);
                // swal("Record Not Rejected");
            }
        });
    });
  

    $("#profileVerificationTable").on("click", "img", function (e) {
        e.preventDefault();

        var image = $(this).data("image");
        
        $("#imagePreview").attr('src', `${image}`);

        $("#imagePreviewModal").modal("show");

    });

});