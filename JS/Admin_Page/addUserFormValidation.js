$(document).ready(function () {
    // Add user
    $("#add-btn").click(function () {
        let userName = document.getElementById("add_userName").value;
        let password = document.getElementById("add_password").value;
        let email = document.getElementById("add_email").value;
        let phone = document.getElementById("add_phone").value;
        let userType = document.getElementById("add_userType").textContent;
        let status = $("#add_status").text();
        let data = {
            method: 'add_user',
            userName: userName,
            password: password,
            email: email,
            phone: phone,
            userType: userType,
            status: status
        };

        if (formValidation(data)) {
            console.log(data);
            fetch('../../phpFunctions/addUser.php', {
                method: 'POST',
                body: JSON.stringify(data),

            }).then(response => response.text()).then(response => {
                console.log(response);
            }).catch(error => console.log(error));
        } else {
            console.log('form false');
        }

    });

    // form validation
    function formValidation(data) {
        let form = true;
        let add_user_msg = $("#add-name-msg").text();
        let add_email_msg = $("#add-email-msg").text();
        let add_number_msg = $("#add-number-msg").text();

        if (add_user_msg !== '' || data.userName === '') {
            $("#add-name-msg").text('please enter your name');
            console.log('add_user_msg');
            form = false;
        }

        if (add_email_msg !== '' || data.email === '') {
            $("#add-email-msg").text('please enter your email');
            console.log('add_email_msg');
            form = false;
        }

        if (add_number_msg !== '' || data.phone === '') {
            $("#add-number-msg").text('please enter your email');
            console.log('add_number_msg');
            form = false;
        }


        return form;
    }

    // Name checking
    $("#add_userName").keyup(function () {
        let enter_text = $(this).val();
        if (enter_text == "") {
            $("#add-name-msg").text('please enter your name');
        } else {
            let value = {
                method: 'checkName',
                value: enter_text
            }
            $.ajax({
                type: "POST",
                url: '../../phpFunctions/addUserFormValidation.php',
                data: value,
                success: function (response) {
                    let msg = JSON.parse(response);
                    console.log(msg);
                    if (msg.status == 'fail') {
                        $("#add-name-msg").text(msg.msg);
                    } else {
                        $("#add-name-msg").text('');
                    }
                }
            });
        }

    });

    // email checking If Exist
    $("#add_email").keyup(function () {
        let enter_text = $(this).val();
        if (enter_text == "") {
            $("#add-email-msg").text('please enter your email');
        } else {
            let value = {
                method: 'checkEmailIsExist',
                value: enter_text
            }
            $.ajax({
                type: "POST",
                url: '../../phpFunctions/addUserFormValidation.php',
                data: value,
                success: function (response) {
                    let msg = JSON.parse(response);
                    console.log(msg);
                    if (msg.status == 'fail') {
                        $("#add-email-msg").text(msg.msg);
                    } else {
                        $("#add-email-msg").text('');
                    }
                }
            });
        }

    });

    // email phone If Exist
    $("#add_phone").keyup(function () {
        let enter_text = $(this).val();
        if (enter_text == "") {
            $("#add-number-msg").text('please enter your phone number');
        } else {
            let value = {
                method: 'checkPhone',
                value: enter_text
            }
            $.ajax({
                type: "POST",
                url: '../../phpFunctions/addUserFormValidation.php',
                data: value,
                success: function (response) {
                    let msg = JSON.parse(response);
                    console.log(msg);
                    if (msg.status == 'fail') {
                        $("#add-number-msg").text(msg.msg);
                    } else {
                        $("#add-number-msg").text('');
                    }
                }
            });
        }

    });


});