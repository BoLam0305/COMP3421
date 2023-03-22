$(document).ready(function () {
    console.log("Loading");
    $(".category-dropdown-item").click(function () {
        let selected_category = $(this).text();
        $("#detail-selected-category").text(selected_category);
    });

    $(".promotion-dropdown-item").click(function () {
        let selected_promotion = $(this).text();
        $("#detail-selected-promotion").text(selected_promotion);
    });

    $(".status-dropdown-item").click(function () {
        let selected_status = $(this).text();
        $("#detail-selected-status").text(selected_status);
    });

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

    // Edit btn on click
    $(".modal-form-edit-btn").click(function () {
        $("#detail-item-form input").prop('disabled', false);
        $("#detail-selected-status").prop('disabled', false);
        $("#detail-selected-promotion").prop('disabled', false);
        $("#detail-selected-category").prop('disabled', false);

    });


    // Detail Modal Get Product By ID
    $(".detail-modal-btn").click(function () {
        let productID = $(this).attr("value");
        // $("#detail-email-msg").text("");
        // $("#detail-phone-msg").text("");
        let data = {
            productID: productID
        }
        fetch('../../phpFunctions/getProductByID.php', {
            method: 'POST',
            body: JSON.stringify(data),

        }).then(response => response.text()).then(response => {
            let product = JSON.parse(response);
            console.log(product.productName);
            $("#detail-item-form input").prop('disabled', true);
            $("#detail-selected-status").prop('disabled', true);
            $("#detail-selected-category").prop('disabled', true);
            $("#detail-selected-promotion").prop('disabled', true);
            $("#detail-productName").val(product.productName);
            $("#detail-productPrice").val(product.Price);
            $("#detail-stock").val(product.Stock);
            $("#detail-selected-status").text(product.status);
            $("#detail-selected-category").text(product.category);
            $("#detail-selected-promotion").text(product.isPromoted);
            $("#modal-product_id").text(product.id);
        }).catch(error => console.log(error));
    });



});
function fileValue2(value) {
    console.log('hi');
    var path = value.value;
    console.log(path);
    var extenstion = path.split('.').pop();
    if (extenstion == "jpg" || extenstion == "svg" || extenstion == "jpeg" || extenstion == "png" || extenstion == "gif") {
        document.getElementById('detail-image-preview').src = window.URL.createObjectURL(value.files[0]);
        var filename = path.replace(/^.*[\\\/]/, '').split('.').slice(0, -1).join('.');
        document.getElementById("detail-filename").innerHTML = filename;
    } else {
        alert("File not supported. Kindly Upload the Image of below given extension ")
    }
}

function fileValue(value) {
    console.log('hi2');

    var path = value.value;
    var extenstion = path.split('.').pop();
    if (extenstion == "jpg" || extenstion == "svg" || extenstion == "jpeg" || extenstion == "png" || extenstion == "gif") {
        document.getElementById('detail-image-preview').src = window.URL.createObjectURL(value.files[0]);
        var filename = path.replace(/^.*[\\\/]/, '').split('.').slice(0, -1).join('.');
        document.getElementById("detail-filename").innerHTML = filename;
    } else {
        alert("File not supported. Kindly Upload the Image of below given extension ")
    }
}




