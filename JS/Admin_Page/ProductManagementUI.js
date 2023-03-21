$(document).ready(function () {
    console.log("ready!");
    // add-status-dropdown on click
    $(".add-status-dropdown").click(function () {
        let selected_status = $(this).text();
        $("#add-status-msg").text("");
        $("#add_status").text(selected_status);
    });

    // add-userType-dropdown on click
    $(".add-userType-dropdown").click(function () {
        let selected_userType = $(this).text();
        $("#add-type-msg").text("");
        $("#add_userType").text(selected_userType);
    });

    // detail-status-dropdown on click
    $(".detail-status-dropdown").click(function () {
        let selected_status = $(this).text();
        $("#detail-status").text(selected_status);
    });

    // Edit btn on click
    $(".modal-form-edit-btn").click(function () {
        $("#detail-form input").prop('disabled', false);
        $("#detail-status").prop('disabled', false);
        $("#detail-promote").prop('disabled', false);
        $("#detail-category").prop('disabled', false);

    });


    // Detail Modal Get User By ID
    $(".detail-modal-btn").click(function () {
        let productID = $(this).attr("value");
        $("#detail-email-msg").text("");
        $("#detail-phone-msg").text("");
        let data = {
            productID: productID
        }
        fetch('../../phpFunctions/getProductByID.php', {
            method: 'POST',
            body: JSON.stringify(data),

        }).then(response => response.text()).then(response => {
            console.log(response);
            let product = JSON.parse(response);
            console.log(product);
            $("#detail-form input").prop('disabled', true);
            $("#detail-status").prop('disabled', true);
            $("#detail-category").prop('disabled', true);
            $("#detail-promote").prop('disabled', true);
            $("#detail-productName").val(product.productName);
            $("#detail-price").val(product.Price);
            $("#detail-stock").val(product.Stock);
            $("#detail-status").text(product.status);
            $("#detail-category").text(product.category);
            $("#detail-promote").text(product.isPromoted);
            $("#modal-product_id").text(product.id);
        }).catch(error => console.log(error));
    });


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').attr("src",e.target.result);
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imageUpload").change(function () {
        readURL(this);
    });

    
    function fileValue(value) {
        var path = value.value;
        var extenstion = path.split('.').pop();
        if (extenstion == "jpg" || extenstion == "svg" || extenstion == "jpeg" || extenstion == "png" || extenstion == "gif") {
            document.getElementById('image-preview').src = window.URL.createObjectURL(value.files[0]);
            var filename = path.replace(/^.*[\\\/]/, '').split('.').slice(0, -1).join('.');
            document.getElementById("filename").innerHTML = filename;
        } else {
            alert("File not supported. Kindly Upload the Image of below given extension ")
        }
    }

});