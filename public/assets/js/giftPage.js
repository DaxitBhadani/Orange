// diamondPackForm
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#giftTable").dataTable({
        processing: true,
        serverSide: true,
        serverMethod: "post",
        aaSorting: [
            [0, "desc"]
        ],
        columnDefs: [{
            targets: [0, 1, 2],
            orderable: false,
        },],
        ajax: {
            url: `giftList`,
            data: function (data) {},
            error: (error) => {
                console.log(error);
            },
        },
    });

   
    $(document).on("submit", "#giftForm", function (e) {
        e.preventDefault();
        let formData = new FormData($("#giftForm")[0]);

        $.ajax({
            type: "POST",
            url: `${domainURL}addGift`,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == false) {
                    console.log(response.errors);
                } else if (response.status == true) {
                    swal("Gift Added successfully", {
                        icon: "success",
                    });
                    $("#giftTable").DataTable().ajax.reload(null, false);
                    $('#giftModal').modal('hide');
                }
            },
        });
    }); 

    $("#giftTable").on("click", ".edit", function (e) {
        e.preventDefault();

        var id = $(this).attr("rel");
        var image = $(this).data("image");
        var price = $(this).data("price");
    
        $("#giftID").val(id);
        $("#editGiftImage").attr('src', `upload/gift/${image}`);
        $("#editGiftPrice").val(price);

        $("#editGiftModal").modal("show");

    });


    $(document).on('submit', '#editGiftForm', function (e) {
        e.preventDefault();
        var id = $('#giftID').val();
        console.log(id);
        let EditformData = new FormData($('#editGiftForm')[0]);

        $.ajax({
            type: "POST",
            url: `${domainURL}updateGift/` + id,
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
                    //     title: "Gift Updated Succesfully!",
                    //     icon: "success",
                    // });
                    $("#giftTable").DataTable().ajax.reload(null, false);
                    $('#editGiftModal').modal('hide');

                }
            }
        });
    });


    
    $("#giftTable").on('click', '.delete', function (e) {
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
                        url: `${domainURL}deleteGift/` + id,
                        dataType: "json",
                        success: function (response) {
                            if (response.status == 404) {
                                console.log(response.message);
                            } else if (response.status == 200) {
                                $("#giftTable").DataTable().ajax.reload(null, false);
                                swal(
                                    `Gift Deleted Successfully`, {
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