$(document).ready(function () {

    // Add user
    $("#submitBtn").click(function () {
        console.log('add btn click');
        let userID = document.getElementById("userID").value;
        let userName = document.getElementById("userName").value;
        let phone = document.getElementById("userPhone").value;
        let file = document.getElementById("imageUpload").files[0];
        if (formValidation(phone)) {
            var form_data = new FormData();
            form_data.append("userID", userID);
            form_data.append("userName", userName);
            form_data.append("phone", phone);
            form_data.append("file", file);

            $.ajax({
                type: "POST",
                url: '../../phpFunctions/modifyProfile.php',
                data: form_data,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log('return res:');
                    let json = JSON.parse(response);
                    console.log('return:'+json);
                    if (json.status == 'success') {
                        $("#result-msg").text('record update success');
                        $("#result-msg").addClass("status-enable");
                        setTimeout(function () {
                            // Reload the page
                            window.location.href = '../../HTML/user_Page/userProfile.php';

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
    function formValidation(phone) {
        let form = true;
        let add_number_msg = $("#add-number-msg").text();

        if (add_number_msg !== '' || phone === '') {
            $("#add-number-msg").text('please enter your Phone');
            form = false;
        }

        return form;
    }

    // email phone If Exist
    $("#userPhone").keyup(function () {
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