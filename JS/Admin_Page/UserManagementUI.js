$(document).ready(function () {

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
        console.log(userID);
        let data = {
            userID: userID
        }
        console.log(data);
        fetch('../../phpFunctions/getUserByID.php', {
            method: 'POST',
            body: JSON.stringify(data),

        }).then(response => response.json()).then(response => {
            console.log(response);
            let json = JSON.parse(response);
            $("#detail-form input").prop('disabled', true);
            $("#detail-status").prop('disabled', true);
            $("#detail-name").val(json.userName);
            $("#detail-email").val(json.email);
            $("#detail-phone").val(json.phone);
            $("#detail-status").text(json.status);
            $("#modal-user_id").text(json.id);

            console.log(json);
        }).catch(error => console.log(error));
    });


});