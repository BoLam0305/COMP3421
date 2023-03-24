$(document).ready(function () {
    /**
     function getBase64(file, onLoadCallback) {
        return new Promise(function (resolve, reject) {
            var reader = new FileReader();
            reader.onload = function () {
                resolve(reader.result);
            };
            reader.onerror = reject;

            reader.readAsDataURL(file);
        });
    }**/

    // Add user
    // $("#add-btn").click(function () {
    //     console.log('b call');
    //     let userName = document.getElementById("add_userName").value;
    //     let password = document.getElementById("add_password").value;
    //     let email = document.getElementById("add_email").value;
    //     let phone = document.getElementById("add_phone").value;
    //     let userType = document.getElementById("add_userType").textContent;
    //     let status = $("#add_status").text();
    //     let file = document.getElementById("imageUpload").files[0];
    //
    //     /**
    //      if (file != null) {
    //         var promise = getBase64(file);
    //         promise.then(function (result) {
    //
    //         });
    //         var my_pdf_file_as_base64 = await promise;
    //     }**/
    //     let data = {
    //         method: 'add_user',
    //         userName: userName,
    //         password: password,
    //         email: email,
    //         phone: phone,
    //         userType: userType,
    //         status: status,
    //         icon: file
    //     };
    //
    //     //formValidation(data)
    //     if (true) {
    //         var form_data = new FormData();
    //
    //         form_data.append("userName", data.userName);
    //         form_data.append("password", data.password);
    //         form_data.append("email", data.email);
    //         form_data.append("phone", data.phone);
    //         form_data.append("userType", data.userType);
    //         form_data.append("status", data.status);
    //         form_data.append("file", data.icon);
    //         console.log(data);
    //         $.ajax({
    //             type: "POST",
    //             url: '../../phpFunctions/addUser.php',
    //             data: form_data,
    //             success: function (response) {
    //
    //                 console.log(response);
    //             }
    //         });
    //     }
    // });

    // Add user
    $("#add-btn").click(function () {
        let userName = document.getElementById("add_userName").value;
        let password = document.getElementById("add_password").value;
        let email = document.getElementById("add_email").value;
        let phone = document.getElementById("add_phone").value;
        let userType = document.getElementById("add_userType").textContent;
        let status = $("#add_status").text();
        let file = document.getElementById("imageUpload").files[0];

        if (formValidation(email, phone)) {
            var form_data = new FormData();

            form_data.append("userName", userName);
            form_data.append("password", password);
            form_data.append("email", email);
            form_data.append("phone", phone);
            form_data.append("userType", userType);
            form_data.append("status", status);
            form_data.append("file", file);

            $.ajax({
                type: "POST",
                url: '../../phpFunctions/addUser.php',
                data: form_data,
                contentType: false,
                processData: false,
                success: function (response) {
                    let json = JSON.parse(response);
                    console.log(json.status);
                    if (json.status == 'success') {
                        $("#result-msg").text('record update success');
                        $("#result-msg").addClass("status-enable");

                        setTimeout(function () {
                            // Reload the page
                            window.location.href = '../../HTML/Admin_Page/OrderManagement.php';

                        }, 2000);
                    } else {
                        $("#result-msg").text('record update fail');
                        $("#result-msg").addClass("status-disable");
                    }

                }
            });
        }
    });

    // form validation
    function formValidation(email, phone) {
        let form = true;
        let add_email_msg = $("#add-email-msg").text();
        let add_number_msg = $("#add-number-msg").text();

        if (add_email_msg !== '' || email === '') {
            $("#add-email-msg").text('please enter your email');
            console.log('add_email_msg');
            form = false;
        }

        if (add_number_msg !== '' || phone === '') {
            $("#add-number-msg").text('please enter your email');
            console.log('add_number_msg');
            form = false;
        }

        return form;
    }

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

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').attr("src", e.target.result);
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imageUpload").change(function () {
        readURL(this);
    });


});