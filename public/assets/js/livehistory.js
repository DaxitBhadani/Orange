$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // liveHistoryTable
    $("#liveHistoryTable").dataTable({
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
            url: `liveHistoryList`,
            data: function (data) {},
            error: (error) => {
                console.log(error);
            }
        },
    });

});