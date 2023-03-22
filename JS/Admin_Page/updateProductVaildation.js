$(document).ready(function () {
    console.log('updata ready');
    // Detail Modal Update User By ID
    $("#detain-save-btn").click(function () {
        let productID = $("#modal-product_id").text();
        let productName = $("#detail-productName").val();
        let price = $("#detail-price").val();
        let stock = $("#detail-stock").val();
        let promote = $("#detail-promote").text();
        let status = $("#detail-status").text();
        let category = $("#detail-category").text();

        let data = {
            productID: productID,
            productName: productName,
            price: price,
            stock: stock,
            promote: promote,
            status: status,
            category: category,
        };

        console.log(data);

        // if (formValidation(data)){
        //     fetch('../../phpFunctions/updateUserByID.php', {
        //         method: 'POST',
        //         body: JSON.stringify(data),

        //     }).then(response => response.text()).then(response => {
        //         if (response == 'success') {
        //             location.reload();
        //         } else {
        //             console.log('fail');
        //         }
        //     }).catch(error => console.log(error));
        // }

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
    $("#detail-price").keyup(function () {
        let enter_text = $(this).val();
        let userID = $("#modal-user_id").text();
        if (enter_text == "") {
            $("#add-price-msg").text('please enter the price');
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


});