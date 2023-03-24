$(document).ready(function () {
    console.log('updata ready');
    // Detail Modal Update User By ID
    $("#detain-save-btn").click(function () {
        let productID = $("#modal-product_id").text();
        let productName = $("#detail-productName").val();
        let price = $("#detail-productPrice").val();
        let stock = $("#detail-stock").val();
        let promote = $("#detail-selected-promotion").text();
        let status = $("#detail-selected-status").text();
        let category = $("#detail-selected-category").text();

        let file = document.getElementById("imageUpload").files[0];

        if (promote == 'Promoting') {
            promote = 1;
        } else {
            promote = 0;
        }

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

        if (formValidation(data)) {
            var form_data = new FormData();
            form_data.append("productID", productID);
            form_data.append("productName", productName);
            form_data.append("price", price);
            form_data.append("stock", stock);
            form_data.append("promote", promote);
            form_data.append("status", status);
            form_data.append("category", category);
            form_data.append("file", file);

            fetch('../../phpFunctions/updataProductByID.php', {
                method: 'POST',
                body: form_data

            }).then(response => response.text()).then(response => {
                console.log(response);
                let json = JSON.parse(response);

                if (json.status == 'success') {
                    $("#detail-result-msg").text('record update success');
                    $("#detail-result-msg").addClass("status-enable");

                    setTimeout(function () {
                        // Reload the page
                        window.location.href = '../../HTML/Admin_Page/ProductManagement.php';
                    }, 2000);
                } else {
                    $("#detail-result-msg").text('record update fail');
                    $("#detail-result-msg").addClass("status-disable");
                }
            }).catch(error => console.log(error));
        }

    });

    // form validation
    function formValidation(data) {
        let form = true;
        let detail_product_msg = $("#detail-productName-msg").text();
        let detail_price_msg = $("#detail-price-msg").text();
        let detail_stock_msg = $("#detail-stock-msg").text();

        if (detail_product_msg !== '' || data.productName === '') {
            $("#detail-productName-msg").text('Please enter an valid Name');

            form = false;
        }
        if (detail_price_msg !== '' || data.price === '' || data.price < 0) {
            $("#detail-productName-msg").text('Please enter an valid Price');

            form = false;
        }
        if (detail_stock_msg !== '' || data.stock === '' || data.stock < 0) {
            $("#detail-productName-msg").text('Please enter an valid Stock');

            form = false;
        }

        return form;
    }

    //Name checking If Exist
    $("#detail-productName").keyup(function () {
        let enter_text = $(this).val();
        let productID = $("#modal-product_id").text();
        if (enter_text == "") {
            $("#detail-productName-msg").text('Please enter a product name');
        } else {
            let value = {
                method: 'checkName',
                value: enter_text,
                productID: productID,
            }
            console.log(value);
            $.ajax({
                type: "POST",
                url: '../../phpFunctions/updateProductFromValidation.php',
                data: value,
                success: function (response) {
                    let msg = JSON.parse(response);
                    console.log(msg);
                    if (msg.status == 'fail') {
                        $("#detail-productName-msg").text(msg.msg);
                    } else {
                        $("#detail-productName-msg").text('');
                    }
                }
            });
        }

    });

    $("#detail-productPrice").keyup(function () {
        let enter_text = $(this).val();

        if (enter_text == "") {
            $("#detail-price-msg").text('Please enter Price');
        } else if (enter_text <= 0) {
            $("#detail-price-msg").text('Please enter a valid Price');
        } else {
            $("#detail-price-msg").text('');
        }

    });

    $("#detail-stock").keyup(function () {
        let enter_text = $(this).val();
        if (enter_text == "") {
            $("#detail-stock-msg").text('Please enter Stock');
        } else if (enter_text <= 0) {
            $("#detail-stock-msg").text('Please enter a valid Stock');
        } else {
            $("#detail-stock-msg").text('');
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
    // email checking If Exist
    // $("#detail-email").keyup(function () {
    //     let enter_text = $(this).val();
    //     let userID = $("#modal-user_id").text();
    //     if (enter_text == "") {
    //         $("#add-email-msg").text('please enter your email');
    //     } else {
    //         let value = {
    //             method: 'checkEmailIsExist',
    //             value: enter_text,
    //             formUserID: userID
    //         };
    //         $.ajax({
    //             type: "POST",
    //             url: '../../phpFunctions/updateUserFromValidation.php',
    //             data: value,
    //             success: function (response) {
    //                 let msg = JSON.parse(response);
    //                 console.log(msg);
    //                 if (msg.status == 'fail') {
    //                     $("#detail-email-msg").text(msg.msg);
    //                 } else {
    //                     $("#detail-email-msg").text('');
    //                 }
    //             }
    //         });
    //     }

    // });

    // email phone If Exist
    // $("#detail-price").keyup(function () {
    //     let enter_text = $(this).val();
    //     let userID = $("#modal-user_id").text();
    //     if (enter_text == "") {
    //         $("#detail-price-msg").text('Please enter the price');
    //     } else {
    //         let value = {
    //             method: 'checkPhone',
    //             value: enter_text,
    //             formUserID: userID
    //         }
    //         $.ajax({
    //             type: "POST",
    //             url: '../../phpFunctions/updateUserFromValidation.php',
    //             data: value,
    //             success: function (response) {
    //                 let msg = JSON.parse(response);
    //                 console.log(msg);
    //                 if (msg.status == 'fail') {
    //                     $("#detail-phone-msg").text(msg.msg);
    //                 } else {
    //                     $("#detail-phone-msg").text('');
    //                 }
    //             }
    //         });
    //     }

    // });


});