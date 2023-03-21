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

    // Add user
    $("#add-btn").click(async function () {
        console.log('b call');
        let userName = document.getElementById("add_userName").value;
        let password = document.getElementById("add_password").value;
        let email = document.getElementById("add_email").value;
        let phone = document.getElementById("add_phone").value;
        let userType = document.getElementById("add_userType").textContent;
        let status = $("#add_status").text();
        let file = document.getElementById("imageUpload").files[0];
        if (file != null) {
            var promise = getBase64(file);
            promise.then(function (result) {

            });
            var my_pdf_file_as_base64 = await promise;
        }
        let data = {
            method: 'add_user',
            userName: userName,
            password: password,
            email: email,
            phone: phone,
            userType: userType,
            status: status,
            icon: my_pdf_file_as_base64
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
        console.log('f call');
        let form = true;
        let add_email_msg = $("#add-email-msg").text();
        let add_number_msg = $("#add-number-msg").text();

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