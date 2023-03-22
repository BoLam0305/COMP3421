$(document).ready(function () {
    $(".category-dropdown-item").click(function () {
        let selected_category = $(this).text();
        $("#selected-category").text(selected_category);
    });

    $(".promotion-dropdown-item").click(function () {
        let selected_promotion = $(this).text();
        $("#selected-promotion").text(selected_promotion);
    });

    $(".status-dropdown-item").click(function () {
        let selected_status = $(this).text();
        $("#selected-status").text(selected_status);
    });


    // Detail Modal Get Product By ID
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