$(document).ready(function () {


    // Detail Modal Update User By ID
    $("#detain-save-btn").click(function () {
        let userID = $("#modal-user_id").text();
        let userName = $("#detail-name").val();
        let email = $("#detail-email").val();
        let phone = $("#detail-phone").val();
        let status = $("#detail-status").text();

        let file = document.getElementById("imageUpload").files[0];
        if (file == null) {
            file = $('#detail_img_name').text();
            console.log('No file selected');
        }

        if (formValidation(email, phone)) {
            var form_data = new FormData();
            form_data.append("userID", userID);
            form_data.append("userName", userName);
            form_data.append("email", email);
            form_data.append("phone", phone);
            form_data.append("status", status);
            form_data.append("file", file);

            $.ajax({
                type: "POST",
                url: '../../phpFunctions/updateUserByID.php',
                data: form_data,
                contentType: false,
                processData: false,
                success: function (response) {
                    let json = JSON.parse(response);
                    console.log(json.status);
                    if (json.status == 'success') {
                        $("#detail-result-msg").text('record update success');
                        $("#detail-result-msg").addClass("status-enable");

                        setTimeout(function () {
                            // Reload the page
                            window.location.href = '../../HTML/Admin_Page/UserManagement.php';

                        }, 2000);
                    } else {
                        $("#detail-result-msg").text('record update fail');
                        $("#detail-result-msg").addClass("status-disable");
                    }
                }
            });
        }


    });

    // form validation
    function formValidation(email, phone) {
        let form = true;
        let detail_email_msg = $("#detail-email-msg").text();
        let detail_number_msg = $("#detail-phone-msg").text();

        if (detail_email_msg !== '' || email === '') {
            $("#detail-email-msg").text('please enter an valid email');
            console.log('detail_email_msg');
            form = false;
        }

        if (detail_number_msg !== '' || phone === '') {
            $("#detail-phone-msg").text('please enter an valid phone number');
            console.log('detail_number_msg');
            form = false;
        }

        return form;
    }

    // email checking If Exist
    $("#detail-email").keyup(function () {
        let enter_text = $(this).val();
        let userID = $("#modal-user_id").text();
        if (enter_text == "") {
            $("#add-email-msg").text('please enter your email');
        } else {
            let value = {
                method: 'checkEmailIsExist',
                value: enter_text,
                formUserID: userID
            };
            $.ajax({
                type: "POST",
                url: '../../phpFunctions/updateUserFromValidation.php',
                data: value,
                success: function (response) {
                    let msg = JSON.parse(response);
                    console.log(msg);
                    if (msg.status == 'fail') {
                        $("#detail-email-msg").text(msg.msg);
                    } else {
                        $("#detail-email-msg").text('');
                    }
                }
            });
        }

    });

    // email phone If Exist
    $("#detail-phone").keyup(function () {
        let enter_text = $(this).val();
        let userID = $("#modal-user_id").text();
        if (enter_text == "") {
            $("#add-number-msg").text('please enter your phone number');
        } else {
            let value = {
                method: 'checkPhone',
                value: enter_text,
                formUserID: userID
            }
            $.ajax({
                type: "POST",
                url: '../../phpFunctions/updateUserFromValidation.php',
                data: value,
                success: function (response) {
                    let msg = JSON.parse(response);
                    console.log(msg);
                    if (msg.status == 'fail') {
                        $("#detail-phone-msg").text(msg.msg);
                    } else {
                        $("#detail-phone-msg").text('');
                    }
                }
            });
        }

    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#detail_imagePreview').attr("src", e.target.result);
                $('#detail_imagePreview').hide();
                $('#detail_imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imageUpload").change(function () {
        readURL(this);
    });


});