$(document).ready(function () {
    function getBase64(file, onLoadCallback) {
        return new Promise(function (resolve, reject) {
            var reader = new FileReader();
            reader.onload = function () {
                resolve(reader.result);
            };
            reader.onerror = reject;
            reader.readAsDataURL(file);
        });
    }

    // Detail Modal Update User By ID
    $("#detain-save-btn").click(async function () {
        let userID = $("#modal-user_id").text();
        let userName = $("#detail-name").val();
        let email = $("#detail-email").val();
        let phone = $("#detail-phone").val();
        let status = $("#detail-status").text();

        let file = document.getElementById("imageOnLoad").files[0];
        var promise = getBase64(file);
        promise.then(function (result) {

        });
        var my_pdf_file_as_base64 = await promise;
        let data = {
            userID: userID,
            userName: userName,
            email: email,
            phone: phone,
            status: status,
            icon:my_pdf_file_as_base64
        };

        if (formValidation(data)) {
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
        }

    });

    // form validation
    function formValidation(data) {
        let form = true;
        let detail_email_msg = $("#detail-email-msg").text();
        let detail_number_msg = $("#detail-phone-msg").text();

        if (detail_email_msg !== '' || data.email === '') {
            $("#detail-email-msg").text('please enter an valid email');
            console.log('detail_email_msg');
            form = false;
        }

        if (detail_number_msg !== '' || data.phone === '') {
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

    function readURL_Detail(input) {
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
        readURL_Detail(this);
    });


});