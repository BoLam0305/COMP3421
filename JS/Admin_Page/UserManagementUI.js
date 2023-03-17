$(document).ready(function () {

    // add-status-dropdown on click
    $(".add-status-dropdown").click(function () {
        let selected_status = $(this).text();
        $("#add_status").text(selected_status);
    });

    // add-userType-dropdown on click
    $(".add-userType-dropdown").click(function () {
        let selected_userType = $(this).text();
        $("#add_userType").text(selected_userType);
    });

    // detail-status-dropdown on click
    $(".detail-status-dropdown").click(function () {
        let selected_status = $(this).text();
        $("#detail-status").text(selected_status);
    });

    // Edit btn on click
    $(".modal-form-edit-btn").click(function () {
        $("input").prop('disabled', false);
        $("#detail-status").prop('disabled', false);

    });
    // Add user
    $("#add-btn").click(function () {
        let userName = document.getElementById("add_userName").value;
        let password = document.getElementById("add_password").value;
        let email = document.getElementById("add_email").value;
        let phone = document.getElementById("add_phone").value;
        let userType = document.getElementById("add_userType").textContent;
        let status = document.getElementById("add_status").textContent;
        let data = {
            method: 'add_user',
            userName: userName,
            password: password,
            email: email,
            phone: phone,
            userType: userType,
            status: status
        };
        console.log(JSON.stringify(data));
        fetch('../../phpFunctions/UserManagementQuery.php', {
            method: 'POST',
            body: JSON.stringify(data),

        }).then(response => response.text()).then(response => {
            console.log(response);
        }).catch(error => console.log(error));
    });

    // Detail Modal Get User By ID
    $(".detail-modal-btn").click(function () {
        let userID = $(this).attr("value");
        let data = {
            userID:userID
        }
        fetch('../../phpFunctions/getUserByID.php', {
            method: 'POST',
            body: JSON.stringify(data),

        }).then(response => response.text()).then(response => {
            let user = JSON.parse(response);
            $("input").prop('disabled', true);
            $("#detail-status").prop('disabled', true);
            $("#detail-name").val(user.userName);
            $("#detail-email").val(user.email);
            $("#detail-phone").val(user.phone);
            $("#detail-status").text(user.status);
        }).catch(error => console.log(error));
    });

    $("#detain-save-btn").click(function () {
       console.log('detain-save-btn');
    });

});