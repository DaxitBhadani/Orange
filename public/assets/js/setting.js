$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var user_type = 1;

    $("#settingForm").on("change", ".for_dating_app", function (event) {
        event.preventDefault();
        swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
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
                        `${domainURL}updateSetting`,
                        {
                            for_dating_app: $value,
                        },
                        function (returnedData) {
                            console.log(returnedData);
                            window.location.reload();
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
                // window.location.reload();
                swal("Status Not Changed");
            }
        });
    });

    $(document).on('submit', '#settingForm', function (e) {
        e.preventDefault();
      
        let EditformData = new FormData($('#settingForm')[0]);

        $.ajax({
            type: "POST",
            url: `${domainURL}updateSetting`,
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
                        title: "Setting Updated Succesfully!",
                        icon: "success",
                    });
                    // window.location.reload();
                }
            }
        });
    });
});
