// diamondPackForm
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $("#interestTable").dataTable({
        processing: true,
        serverSide: true,
        serverMethod: "post",
        aaSorting: [
            [0, "desc"]
        ],
        columnDefs: [{
            targets: [0, 1],
            orderable: false,
        },],
        ajax: {
            url: `interestList`,
            data: function (data) {},
            error: (error) => {
                console.log(error);
            },
        },
    });

   
    $(document).on("submit", "#addInterestForm", function (e) {
        e.preventDefault();
        let formData = new FormData($("#addInterestForm")[0]);

        $.ajax({
            type: "POST",
            url: `${domainURL}addInterest`,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 400) {
                    console.log(response.errors);
                } else if (response.status == 200) {
                    swal("Interest Added successfully", {
                        icon: "success",
                    });
                    $("#interestTable").DataTable().ajax.reload(null, false);
                    $('#interestModal').modal('hide');
                }
            },
        });
    }); 


    $("#interestTable").on("click", ".edit", function (e) {
        e.preventDefault();

        var id = $(this).attr("rel");
        var title = $(this).data("title");
    
        $("#interestID").val(id);
        $("#editInterest").val(title);

        $("#editInterestModal").modal("show");

    });

    
    $(document).on('submit', '#editInterestForm', function (e) {
        e.preventDefault();
        var id = $('#interestID').val();
        console.log(id);
        let EditformData = new FormData($('#editInterestForm')[0]);

        $.ajax({
            type: "POST",
            url: `${domainURL}updateInterest/` + id,
            data: EditformData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 400) {
                    console.log("400");
                    console.log(response.errors);
                } else if (response.status == 404) {
                    alert(response.message);
                } else if (response.status == 200) {
                    // swal({
                    //     title: "Interest Updated Succesfully!",
                    //     icon: "success",
                    // });
                    $("#interestTable").DataTable().ajax.reload(null, false);
                    $('#editInterestModal').modal('hide');

                }
            }
        });
    });

       
    $("#interestTable").on('click', '.delete', function (e) {
        e.preventDefault();

        var id = $(this).attr('rel');
        console.log(id);

        swal({
            title: "Are you sure You want to delete!",
            icon: "error",
            buttons: true,
            dangerMode: true,
        })
        .then((deleteValue) => {
            if (deleteValue) {
                if (deleteValue == true) {
                    $.ajax({
                        type: "POST",
                        url: `${domainURL}deleteInterest/` + id,
                        dataType: "json",
                        success: function (response) {
                            if (response.status == 404) {
                                console.log(response.message);
                            } else if (response.status == 200) {
                                $("#interestTable").DataTable().ajax.reload(null, false);
                                swal(
                                    `Interest Deleted Successfully`, {
                                    icon: "success",
                                });
                                console.log(response.message);
                            }
                        }
                    });
                }
            }
        });
    });



});