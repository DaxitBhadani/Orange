$(document).ready(function () {

    // var identity = $("#identity").val();
    // console.log(identity);

    var user_type = 1;
    
    $("#allUserTable").dataTable({
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
            url: `allUserslist`,
            data: function (data) {},
            error: (error) => {
                console.log(error);
            },
        },
    });

    $("#fakeUsersTable").dataTable({
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
            url: `fakeUsersList`,
            data: function (data) {},
            error: (error) => {
                console.log(error);
            },
        },
    });


    $("#liveStreamersTable").dataTable({
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
            url: `LiveStreamerList`,
            data: function (data) {},
            error: (error) => {
                console.log(error);
            },
        },
    });


    $(document).on("submit", "#addFakeUserForm", function (e) {
        e.preventDefault();
        let formData = new FormData($("#addFakeUserForm")[0]);

        $.ajax({
            type: "POST",
            url: `${domainURL}addFakeUser`,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == false) {
                    console.log(response.errors);
                } else if (response.status == true) {
                    $("#allUserTable").DataTable().ajax.reload(null, false);
                    $("#fakeUsersTable").DataTable().ajax.reload(null, false);
                    // $('.page-content').find('form').trigger('reset');
                    window.location.replace("users");
                    // swal({
                    //     title: "User Added Succesfully!",
                    //     icon: "success",
                    // });
                }
            },
        });
    });

    $("#allUserTable").on("change", ".block_user", function (event) {
        event.preventDefault();
        swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                swal("User Is Blocked", {
                    icon: "success",
                });

                if (user_type == "1") {
                    $id = $(this).attr("rel");

                    if ($(this).prop("checked") == true) {
                        swal("User Is Blocked", {
                            icon: "success",
                        });
                        $value = 1;
                        console.log("Checkbox is Checked.");
                        console.log("1 == true");
                    } else {
                        swal("User Is Unblocked", {
                            icon: "success",
                        });
                        $value = 0;
                        console.log("Checkbox is unchecked.");
                        console.log("0 == false");
                    }

                    $.post(
                        "updateBlockUser/" + $id,
                        {
                            id: $id,
                            block_user: $value,
                        },
                        function (returnedData) {
                            console.log(returnedData);
                            $("#allUserTable").DataTable().ajax.reload(null, false);
                            $("#liveStreamersTable").DataTable().ajax.reload(null, false);
                            $("#fakeUsersTable").DataTable().ajax.reload(null, false);
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
                $("#allUserTable").DataTable().ajax.reload(null, false);
                $("#liveStreamersTable").DataTable().ajax.reload(null, false);
                $("#fakeUsersTable").DataTable().ajax.reload(null, false);
                swal("User is Not Added in Block List");
            }
        });
    });

    $("#liveStreamersTable").on("change", ".block_user", function (event) {
        event.preventDefault();
        swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                swal("User Is Blocked", {
                    icon: "success",
                });

                if (user_type == "1") {
                    $id = $(this).attr("rel");

                    if ($(this).prop("checked") == true) {
                        swal("User Is Blocked", {
                            icon: "success",
                        });
                        $value = 1;
                        console.log("Checkbox is Checked.");
                        console.log("1 == true");
                    } else {
                        swal("User Is Unblocked", {
                            icon: "success",
                        });
                        $value = 0;
                        console.log("Checkbox is unchecked.");
                        console.log("0 == false");
                    }

                    $.post(
                        "updateBlockUser/" + $id,
                        {
                            id: $id,
                            block_user: $value,
                        },
                        function (returnedData) {
                            console.log(returnedData);

                            $("#allUserTable").DataTable().ajax.reload(null, false);
                            $("#liveStreamersTable").DataTable().ajax.reload(null, false);
                            $("#fakeUsersTable").DataTable().ajax.reload(null, false);
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
                $("#allUserTable").DataTable().ajax.reload(null, false);
                $("#liveStreamersTable").DataTable().ajax.reload(null, false);
                $("#fakeUsersTable").DataTable().ajax.reload(null, false);
                swal("User is Not Added in Block List");
            }
        });
    });

    $("#fakeUsersTable").on("change", ".block_user", function (event) {
        event.preventDefault();
        swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                swal("User Is Blocked", {
                    icon: "success",
                });

                if (user_type == "1") {
                    $id = $(this).attr("rel");

                    if ($(this).prop("checked") == true) {
                        swal("User Is Blocked", {
                            icon: "success",
                        });
                        $value = 1;
                        console.log("Checkbox is Checked.");
                        console.log("1 == true");
                    } else {
                        swal("User Is Unblocked", {
                            icon: "success",
                        });
                        $value = 0;
                        console.log("Checkbox is unchecked.");
                        console.log("0 == false");
                    }

                    $.post(
                        "updateBlockUser/" + $id,
                        {
                            id: $id,
                            block_user: $value,
                        },
                        function (returnedData) {
                            console.log(returnedData);

                            $("#allUserTable").DataTable().ajax.reload(null, false);
                            $("#liveStreamersTable").DataTable().ajax.reload(null, false);
                            $("#fakeUsersTable").DataTable().ajax.reload(null, false);
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
                $("#allUserTable").DataTable().ajax.reload(null, false);
                $("#liveStreamersTable").DataTable().ajax.reload(null, false);
                $("#fakeUsersTable").DataTable().ajax.reload(null, false);
                swal("User is Not Added in Block List");
            }
        });
    });


    $("#updateUserDetailForm").on("change", ".block_user", function (event) {
        event.preventDefault();

        swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                if (user_type == "1") {
                    $id = $(this).attr("rel");

                    if ($(this).prop("checked") == true) {
                     
                        $value = 1;
                        console.log("Checkbox is Checked.");
                        console.log("1 == true");
                    } else {
                        $value = 0;
                        console.log("Checkbox is unchecked.");
                        console.log("0 == false");
                    }

                    $.post(
                        `${domainURL}updateBlockUser/` + $id,
                        {
                            id: $id,
                            block_user: $value,
                        },

                        function (returnedData) {
                            console.log(returnedData);
                            window.location.reload();
                            $("#allUserTable").DataTable().ajax.reload(null, false);
                            $("#liveStreamersTable").DataTable().ajax.reload(null, false);
                            $("#fakeUsersTable").DataTable().ajax.reload(null, false);
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
                $("#allUserTable").DataTable().ajax.reload(null, false);
                $("#liveStreamersTable").DataTable().ajax.reload(null, false);
                $("#fakeUsersTable").DataTable().ajax.reload(null, false);
                swal("User is Not Added in Block List");
            }
        });
    });


    $("#updateUserDetailForm").on("change", ".live_stream_btn", function (event) {
        event.preventDefault();

        swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                if (user_type == "1") {
                    $id = $(this).attr("rel");

                    if ($(this).prop("checked") == true) {
                     
                        $value = 1;
                        console.log("Checkbox is Checked.");
                        console.log("1 == true");
                    } else {
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
                            window.location.reload();
                            $("#allUserTable").DataTable().ajax.reload(null, false);
                            $("#liveStreamersTable").DataTable().ajax.reload(null, false);
                            $("#fakeUsersTable").DataTable().ajax.reload(null, false);
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
                $("#allUserTable").DataTable().ajax.reload(null, false);
                $("#liveStreamersTable").DataTable().ajax.reload(null, false);
                $("#fakeUsersTable").DataTable().ajax.reload(null, false);
                swal("User is Not Added in Block List");
            }
        });
    });

    $("#updateUserDetailForm").on('click', '.removeImage', function (e) {
        e.preventDefault();

        var id = $(this).attr('rel');
        console.log(id);

        swal({
            title: "Are you sure You want to Remove Image!",
            icon: "error",
            buttons: true,
            dangerMode: true,
        })
        .then((deleteValue) => {
            if (deleteValue) {
                if (deleteValue == true) {
                    $.ajax({
                        type: "POST",
                        url: `${domainURL}removeUserImage/` + id,
                        dataType: "json",
                        success: function (response) {
                            if (response.status == 404) {
                                console.log(response.message);
                            } else if (response.status == 200) {
                                // swal(
                                //     `User Image Removed Successfully`, {
                                //     icon: "success",
                                // });
                                console.log("User Image Removed Successfully");
                                window.location.reload();
                            }
                        }
                    });
                } else {
                    window.location.reload();
                }
            } else {
                window.location.reload();
                
            }
        });


    });

    $(document).on("submit", "#updateUserDetailForm", function (e) {
        e.preventDefault();

        
        var id = $("#user_id").val();
        console.log(id);
        
        let formData = new FormData($("#updateUserDetailForm")[0]);


        $.ajax({
            type: "POST",
            url: `${domainURL}updateUserDetail/` + id,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == false) {
                    console.log(response.errors);
                } else if (response.status == true) {
                    swal({
                        title: "User Detail Updated Succesfully!",
                        icon: "success",
                    }).then(() => {
                        window.location.reload(`${domainURL}updateUserDetail/` + id);
                    });
                }
            },
        });
    });



});