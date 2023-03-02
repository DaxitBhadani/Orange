$(document).ready(function () {

    // live_stream = 0 = No
    // live_stream = 1 = Pending
    // live_stream = 2 = Yes

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    
    var user_type = 1;

    // liveApplicationTable
    $("#liveApplicationTable").dataTable({
        process: true,
        serverSide: true,
        serverMethod: "post",
        aaSorting: [
            [0, "desc"]
        ],
        columnDefs: [{
            targets: [],
            orderable: false,
        }],
        ajax: {
            url: `liveApplicationList`,
            data: function (data) {},
            error: (error) => {
                console.log(error);
            }
        },
    });

//    liveApplicationTable
$("#liveApplicationTable").on("change", ".reject_application", function (event) {
    event.preventDefault();
    swal({
        title: "Are you sure?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            swal("Live Application Rejected", {
                icon: "success",
            });

            if (user_type == "1") {
                $id = $(this).attr("rel");

                if ($(this).prop("checked") == true) {
                    swal("Live Application Rejected", {
                        icon: "success",
                    });
                    $value = 0;
                    console.log("Checkbox is Checked.");
                    console.log("1 == true");
                } else {
                    swal("Live Application Not Rejected", {
                        icon: "success",
                    });
                    $value = 1;
                    console.log("Checkbox is unchecked.");
                    console.log("0 == false");
                }

                $.post(
                    `${domainURL}updateLiveStream/` + $id,
                    {
                        id: $id,
                        live_stream: $value,
                    },
                    function (returnedData) {
                        console.log(returnedData);
                        $("#liveApplicationTable").DataTable().ajax.reload(null, false);
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
            $("#liveApplicationTable").DataTable().ajax.reload(null, false);
            swal("User is Not Added in Block List");
        }
    });
});


$("#liveApplicationDetailForm").on("change", ".reject_application", function (event) {
    event.preventDefault();
    swal({
        title: "Are you sure?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            swal("Live Application Rejected", {
                icon: "success",
            });

            if (user_type == "1") {
                $id = $(this).attr("rel");
                if ($(this).prop("checked") == true) {
                    swal("Live Application Rejected", {
                        icon: "success",
                    });
                    $value = 0;
                    console.log("Checkbox is Checked.");
                    console.log("1 == true");
                    window.location.replace(`${domainURL}liveapplication`);
                } else {
                    swal("Live Application Not Rejected", {
                        icon: "success",
                    });
                    $value = 1;
                    console.log("Checkbox is unchecked.");
                    console.log("0 == false");
                }

                $.post(
                    `${domainURL}updateLiveStream/` + $id,
                    {
                        id: $id,
                        live_stream: $value,
                    },
                    function (returnedData) {
                        console.log(returnedData);
                        $("#liveApplicationTable").DataTable().ajax.reload(null, false);
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
            $("#liveApplicationTable").DataTable().ajax.reload(null, false);
            swal("Live Application Not Rejected");
        }
    });
});


$("#liveApplicationDetailForm").on("change", ".approve_application", function (event) {
    event.preventDefault();
    swal({
        title: "Are you sure?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            swal("Live Application Approved", {
                icon: "success",
            });

            if (user_type == "1") {

                $id = $(this).attr("rel");

                if ($(this).prop("checked") == true) {
                    swal("Live Application Approved", {
                        icon: "success",
                    });
                    $value = 2;
                    console.log("Checkbox is Checked.");
                    console.log("1 == true");
                    window.location.replace(`${domainURL}liveapplication`);
                } else {
                    swal("Live Application Not Approved", {
                        icon: "success",
                    });
                    $value = 0;
                    console.log("Checkbox is unchecked.");
                    console.log("0 == false");
                }

                $.post(
                    `${domainURL}updateLiveStream/` + $id,
                    {
                        id: $id,
                        live_stream: $value,
                    },
                    function (returnedData) {
                        console.log(returnedData);
                        $("#liveApplicationTable").DataTable().ajax.reload(null, false);
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
            $("#liveApplicationTable").DataTable().ajax.reload(null, false);
            swal("Live Application Not Approved");
        }
    });
});


});