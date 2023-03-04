$(document).ready(function () {

    var user_type = 1;

    $("#reportTable").dataTable({
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
            url: `${domainURL}reportList`,
            data: function (data) {},
            error: (error) => {
                console.log(error);
            }
        },
    });

    
    $("#reportTable").on("change", ".blockuser", function (event) {
        event.preventDefault();
        swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                swal("Block User", {
                    icon: "success",
                });
    
                if (user_type == "1") {
                    $id = $(this).attr("rel");
    
                    if ($(this).prop("checked") == true) {
                        swal("User Added In Block list", {
                            icon: "success",
                        });
                        console.log("Checkbox is Checked.");
                        console.log("1 == true");
                    } else {
                        swal("User Not Added In Block list", {
                            icon: "success",
                        });
                        console.log("Checkbox is unchecked.");
                        console.log("0 == false");
                    }
    
                    $.post(
                        `${domainURL}reportBlockUser/` + $id,
                        {
                            id: $id,
                        },
                        function (returnedData) {
                            console.log(returnedData);
                            $("#reportTable").DataTable().ajax.reload(null, false);
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
                $("#reportTable").DataTable().ajax.reload(null, false);
                swal("User is Not Added in Block List");
            }
        });
    });

});