// diamondPackForm
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#diamondPackTable").dataTable({
        processing: true,
        serverSide: true,
        serverMethod: "post",
        aaSorting: [
            [0, "desc"]
        ],
        columnDefs: [{
            targets: [0, 1, 2, 3, 4],
            orderable: false,
        },],
        ajax: {
            url: `diamondPackList`,
            data: function (data) {},
            error: (error) => {
                console.log(error);
            },
        },
    });

   
    $(document).on("submit", "#diamondPackForm", function (e) {
        e.preventDefault();
        let formData = new FormData($("#diamondPackForm")[0]);

        $.ajax({
            type: "POST",
            url: `${domainURL}addDiamondPack`,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == false) {
                    console.log(response.errors);
                } else if (response.status == true) {
                    // swal("Diamond Pack Added successfully", {
                    //     icon: "success",
                    // });
                    $("#diamondPackTable").DataTable().ajax.reload(null, false);
                    $('#diamondPackModal').modal('hide');
                   
                }
            },
        });
    });

    $("#diamondPackTable").on("click", ".edit", function (e) {
        e.preventDefault();

        var id = $(this).attr("rel");
        var diamond_amount = $(this).data("diamond_amount");
        var price = $(this).data("price");
        var android_product_id = $(this).data("android_product_id");
        var ios_product_id = $(this).data("ios_product_id");
    
        $("#diamondPackID").val(id);
        $("#diamond_amount").val(diamond_amount);
        $("#price").val(price);
        $("#android_product_id").val(android_product_id);
        $("#ios_product_id").val(ios_product_id);

        $("#editDiamondPackModal").modal("show");

    });

    // editDiamondPackForm
    $(document).on('submit', '#editDiamondPackForm', function (e) {
        e.preventDefault();
        var id = $('#diamondPackID').val();
        console.log(id);
        let EditformData = new FormData($('#editDiamondPackForm')[0]);

        $.ajax({
            type: "POST",
            url: `${domainURL}updateDiamondPack/` + id,
            data: EditformData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == false) {
                    console.log("400");
                    console.log(response.errors);
                } else if (response.status == 404) {
                    alert(response.message);
                } else if (response.status == true) {
                    // swal({
                    //     title: "Diamond Pack Updated Succesfully!",
                    //     icon: "success",
                    // });
                    $("#diamondPackTable").DataTable().ajax.reload(null, false);
                    $('#editDiamondPackModal').modal('hide');

                }
            }
        });
    });


    $("#diamondPackTable").on('click', '.delete', function (e) {
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
                        url: `${domainURL}deleteDiamondPack/` + id,
                        dataType: "json",
                        success: function (response) {
                            if (response.status == 404) {
                                console.log(response.message);
                            } else if (response.status == 200) {
                                $("#diamondPackTable").DataTable().ajax.reload(null, false);
                                // swal(
                                //     `Diamond Pack Deleted Successfully`, {
                                //     icon: "success",
                                // });
                                console.log(response.message);
                            }
                        }
                    });
                }
            }
        });
    });


});