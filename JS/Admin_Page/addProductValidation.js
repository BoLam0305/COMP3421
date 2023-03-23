$(document).ready(function () {

    $("#add-btn").click(function () {
        let file = document.getElementById("imageUpload").files[0];
        let productName = $("#productName").val();
        let productPrice = $("#productPrice").val();
        let productCategory = $("#selected-category").text();
        let productPromotion = $("#selected-category").text();
        let productStatus = $("#selected-category").text();
        let productStock = $("#stock").val();

        console.log(formValidation(productName, productPrice, productStock));
        if (formValidation(productName, productPrice, productStock)) {
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
        }

    });


    function formValidation(productName, productPrice, stock) {
        let form = true;
        let add_price_msg = $("#add-price-msg").text();
        let add_productName_msg = $("#add-productName-msg").text();
        let add_stock_msg = $("#add-stock-msg").text();

        if (add_price_msg !== '' || productPrice === '') {
            $("#add-price-msg").text('please enter a price');
            console.log('add-price-msg');
            form = false;
        }

        if (add_productName_msg !== '' || productName === '') {
            $("#add-productName-msg").text('please enter a product name');
            console.log('add-productName-msg');
            form = false;
        }

        if (add_stock_msg !== '' || stock === '') {
            $("#add-stock-msg").text('please enter a price');
            console.log('add-stock-msg');
            form = false;
        }

        return form;
    }

    //Name checking If Exist
    $("#productName").keyup(function () {
        checkName($(this).val());
    });

    //Check price is valid
    $("#productPrice").keyup(function () {
        checkPrice($(this).val());
    });

    //Check stock is valid
    $("#stock").keyup(function () {
        checkStock($(this).val());
    });


    function checkPrice($productPrice) {
        if (isNaN($productPrice)) {
            $("#add-price-msg").text('please enter a price');
            return false;
        } else if ($productPrice <= 0) {
            $("#add-price-msg").text('price must greater than 0');
            return false;
        } else {
            $("#add-price-msg").text('');
        }
    }


    function checkName($productName) {
        if ($productName == "") {
            $("#add-productName-msg").text('please enter a product name');
            return false;
        } else {
            let value = {
                method: 'checkProductIsExist',
                value: $productName
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
                        return false;
                    } else {
                        $("#add-productName-msg").text('');
                    }
                }
            });
        }
    }

    function checkStock(stock) {
        if (isNaN(stock)) {
            console.log('null');
            $("#add-stock-msg").text('please enter a stock');

        } else if (stock <= 0) {
            $("#add-stock-msg").text('stock must greater than 0');
        } else {
            $("#add-stock-msg").text('');
        }
    }

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