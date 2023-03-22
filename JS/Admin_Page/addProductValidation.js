$(document).ready(function () {

    $("#add-btn").click(function () {
        let file = document.getElementById("logo").files[0];
        let productName = $("#productName").val();
        let productPrice = $("#productPrice").val();
        let productCategory = $("#selected-category").text();
        let productPromotion = $("#selected-category").text();
        let productStatus = $("#selected-category").text();
        let productStock = $("#stock").val();

        var form_data = new FormData();
        form_data.append("productName", productName);
        form_data.append("productPrice", productPrice);
        form_data.append("productCategory", productCategory);
        form_data.append("productPromotion", productPromotion);
        form_data.append("productStatus", productStatus);
        form_data.append("productStock", productStock);
        form_data.append("file", file);

        $.ajax({
            type: "POST",
            url: '../../phpFunctions/addProduct.php',
            data: form_data,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
            }
        });
    });

    //Name checking If Exist
    $("#productName").keyup(function () {
        let enter_text = $(this).val();
        if (enter_text == "") {
            $("#add-productName-msg").text('please enter a product name');
        } else {
            let value = {
                method: 'checkProductIsExist',
                value: enter_text
            }
            $.ajax({
                type: "POST",
                url: '../../phpFunctions/addProductFormValidation.php',
                data: value,
                success: function (response) {
                    let msg = JSON.parse(response);
                    console.log(msg);
                    if (msg.status == 'fail') {
                        $("#add-productName-msg").text(msg.msg);
                    } else {
                        $("#add-productName-msg").text('');
                    }
                }
            });
        }

    });
});