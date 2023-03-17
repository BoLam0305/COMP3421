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


    // Detail Modal Get User By ID
    $(".detail-modal-btn").click(function () {
        let userID = $(this).attr("value");
        let data = {
            userID: userID
        }
        fetch('../../phpFunctions/getUserByID.php', {
            method: 'POST',
            body: JSON.stringify(data),

        }).then(response => response.text()).then(response => {
            let user = JSON.parse(response);
            console.log(user);
            $("#detail-form input").prop('disabled', true);
            $("#detail-status").prop('disabled', true);
            $("#detail-name").val(user.userName);
            $("#detail-email").val(user.email);
            $("#detail-phone").val(user.phone);
            $("#detail-status").text(user.status);
            $("#modal-user_id").text(user.id);
        }).catch(error => console.log(error));
    });

    // Detail Modal Update User By ID
    $("#detain-save-btn").click(function () {
        let userID = $("#modal-user_id").text();
        let userName = $("#detail-name").val();
        let email = $("#detail-email").val();
        let phone = $("#detail-phone").val();
        let status = $("#detail-status").text();

        let data = {
            userID: userID,
            userName: userName,
            email: email,
            phone: phone,
            status: status
        };

        fetch('../../phpFunctions/updateUserByID.php', {
            method: 'POST',
            body: JSON.stringify(data),

        }).then(response => response.text()).then(response => {
            if (response == 'success') {
                location.reload();
            } else {
                console.log('fail');
            }
        }).catch(error => console.log(error));
    });

});