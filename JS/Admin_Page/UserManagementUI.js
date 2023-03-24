$(document).ready(function () {
    $(".td-status").each(function () {
        let status = $(this).text();
        console.log(status);
        if (status === 'Enable') {
            $(this).addClass("status-enable");
        }

        if (status === 'Disable') {
            $(this).addClass("status-disable");
        }

    });
    // add-status-dropdown on click
    $(".add-status-dropdown").click(function () {
        let selected_status = $(this).text();
        $("#add-status-msg").text("");
        $("#add_status").text(selected_status);
    });

    // add-userType-dropdown on click
    $(".add-userType-dropdown").click(function () {
        let selected_userType = $(this).text();
        $("#add-type-msg").text("");
        $("#add_userType").text(selected_userType);
    });

    // detail-status-dropdown on click
    $(".detail-status-dropdown").click(function () {
        let selected_status = $(this).text();
        $("#detail-status").text(selected_status);
    });

    // Edit btn on click
    $(".modal-form-edit-btn").click(function () {
        $("#detail-form input").prop('disabled', false);
        $("#detail-status").prop('disabled', false);

    });

    //Add modal open
    $("#add-item-btn").click(function () {
        $("#add-email-msg").text("");
        $("#add-phone-msg").text("");
    });

    // Detail Modal Get User By ID
    $(".detail-modal-btn").click(function () {
        let userID = $(this).attr("value");
        $("#detail-email-msg").text("");
        $("#detail-phone-msg").text("");

        var form_data = new FormData();
        form_data.append("userID", userID);

        $.ajax({
            type: "POST",
            url: '../../phpFunctions/getUserByID.php',
            data: form_data,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                let json = JSON.parse(response);
                $("#detail-form input").prop('disabled', true);
                $("#detail-status").prop('disabled', true);
                $("#detail-name").val(json.userName);
                $("#detail-email").val(json.email);
                $("#detail-phone").val(json.phone);
                $("#detail-status").text(json.status);
                $("#modal-user_id").text(json.id);
                $("#detail_imagePreview").attr("src", "../../img/Profile/" + json.img_path);
                $("#detail_img_name").text(json.img_path);
            }
        });

    });


    //DataTable
    var table = $('#myTable').DataTable({
        select: false,
        "columnDefs": [{
            className: "Name",
            "targets": [0],
            "visible": false,
            "searchable": false
        }]
    });//End of create main table
    $('#example tbody').on('click', 'tr', function () {
        alert(table.row(this).data()[0]);

    });

});