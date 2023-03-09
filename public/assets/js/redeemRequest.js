$(document).ready(function () {

    var user_type = 1;

    $("#pendingRedeemTable").dataTable({
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
            url: `${domainURL}pendingRedeemList`,
            data: function (data) {},
            error: (error) => {
                console.log(error);
            }
        },
    });

    

    $("#completedRedeemTable").dataTable({
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
            url: `${domainURL}completedRedeemList`,
            data: function (data) {},
            error: (error) => {
                console.log(error);
            }
        },
    });


    $("#pendingRedeemTable").on("click", ".complete", function (e) {
        e.preventDefault();

        var id = $(this).attr("rel");
        var userimage = $(this).data("userimage");
        var username = $(this).data("username");
        var request_id = $(this).data("request_id");
        var coin_amount = $(this).data("coin_amount");
        var payment_gateway = $(this).data("payment_gateway");
        var account_detail = $(this).data("account_detail");
    
        
        $("#redeemRequestId").val(id);
        $("#userimage").attr('src', `upload/user/${userimage}`);
        $("#redeemCompleteLabel").html(request_id);
        $("#coin_amount").val(coin_amount);
        $("#payment_gateway").val(payment_gateway);
        $("#account_detail").val(account_detail);
        $("#username").html(username);

        $("#redeemCompleteModal").modal("show");

    });


    $("#completedRedeemTable").on("click", ".view", function (e) {
        e.preventDefault();

        var id = $(this).attr("rel");
        var userimage = $(this).data("userimage");
        var username = $(this).data("username");
        var request_id = $(this).data("request_id");
        var coin_amount = $(this).data("coin_amount");
        var payment_gateway = $(this).data("payment_gateway");
        var account_detail = $(this).data("account_detail");
        var amount_paid = $(this).data("amount_paid");
    
        
        $("#redeemRequestId1").val(id);
        $("#userimage1").attr('src', `upload/user/${userimage}`);
        $("#redeemCompleteLabel1").html(request_id);
        $("#coin_amount1").val(coin_amount);
        $("#payment_gateway1").val(payment_gateway);
        $("#account_detail1").val(account_detail);
        $("#amount_paid1").val(amount_paid);
        $("#username1").html(username);

        $("#redeemCompleteViewModal").modal("show");
    });

    $(document).on('submit', '#redeemCompleteForm', function (e) {
        e.preventDefault();
        var id = $('#redeemRequestId').val();
        console.log(id);
        let EditformData = new FormData($('#redeemCompleteForm')[0]);

        $.ajax({
            type: "POST",
            url: `${domainURL}updateRedeemRequest/` + id,
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
                    // swal({
                    //     title: "Amount Paid Succesfully!",
                    //     icon: "success",
                    // });
                    $("#pendingRedeemTable").DataTable().ajax.reload(null, false);
                    $("#completedRedeemTable").DataTable().ajax.reload(null, false);
                    $('#redeemCompleteModal').modal('hide');

                }
            }
        });
    });

    $("#pendingRedeemTable").on("change", ".delete", function (event) {
        event.preventDefault();
        swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                // swal("Redeem Request Deleted", {
                //     icon: "success",
                // });
    
                if (user_type == "1") {
                    $id = $(this).attr("rel");
    
                    if ($(this).prop("checked") == true) {
                        // swal("Redeem Request Deleted", {
                        //     icon: "success",
                        // });
                        $value = 0;
                        console.log("Checkbox is Checked.");
                        console.log("1 == true");
                    } else {
                        // swal("Redeem Request Not Deleted", {
                        //     icon: "success",
                        // });
                        $value = 1;
                        console.log("Checkbox is unchecked.");
                        console.log("0 == false");
                    }
    
                    $.post(
                        `${domainURL}deleteRedeemRequest/` + $id,
                        {
                            id: $id,
                        },
                        function (returnedData) {
                            console.log(returnedData);
                            $("#pendingRedeemTable").DataTable().ajax.reload(null, false);
                            $("#completedRedeemTable").DataTable().ajax.reload(null, false);
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
                $("#pendingRedeemTable").DataTable().ajax.reload(null, false);
                $("#completedRedeemTable").DataTable().ajax.reload(null, false);
                // swal("User is Not Added in Block List");
            }
        });
    });

    $("#completedRedeemTable").on("change", ".delete", function (event) {
        event.preventDefault();
        swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                // swal("Redeem Request Deleted", {
                //     icon: "success",
                // });
    
                if (user_type == "1") {
                    $id = $(this).attr("rel");
    
                    if ($(this).prop("checked") == true) {
                        // swal("Redeem Request Deleted", {
                        //     icon: "success",
                        // });
                        $value = 0;
                        console.log("Checkbox is Checked.");
                        console.log("1 == true");
                    } else {
                        // swal("Redeem Request Not Deleted", {
                        //     icon: "success",
                        // });
                        $value = 1;
                        console.log("Checkbox is unchecked.");
                        console.log("0 == false");
                    }
    
                    $.post(
                        `${domainURL}deleteRedeemRequest/` + $id,
                        {
                            id: $id,
                        },
                        function (returnedData) {
                            console.log(returnedData);
                            $("#pendingRedeemTable").DataTable().ajax.reload(null, false);
                            $("#completedRedeemTable").DataTable().ajax.reload(null, false);
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
                $("#pendingRedeemTable").DataTable().ajax.reload(null, false);
                $("#completedRedeemTable").DataTable().ajax.reload(null, false);
                // swal("User is Not Added in Block List");
            }
        });
    });


});