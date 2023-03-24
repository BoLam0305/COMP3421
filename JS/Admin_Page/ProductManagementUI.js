$(document).ready(function () {
    $(".td-status").each(function () {
        let status = $(this).text();
        console.log(status);
        if (status === 'Disable') {
            $(this).addClass("status-disable");
        }

        if (status === 'Enable') {
            $(this).addClass("status-enable");
        }
    });

    $(".td-stock").each(function () {
        var stock = parseInt($(this).text());
        if (stock < 5) {
            $(this).addClass("status-disable");
            $(this).html('<i class=\'fas fa-exclamation-circle\'></i>\n' + stock);
        } else if (stock < 20) {
            $(this).addClass("status-in-progress");
            $(this).html('<i class=\'fas fa-bell\'></i>\n' + stock);
        } else {
            $(this).addClass("status-enable");
            $(this).html('<i class="fa fa-check-square"></i>\n' + stock);

        }

    });

    $(".add-category-dropdown-item").click(function () {
        let selected_category = $(this).text();
        $("#add-selected-category").text(selected_category);
    });

    // add-status-dropdown on click
    $(".add-status-dropdown-item").click(function () {
        let selected_status = $(this).text();
        $("#add-selected-status").text(selected_status);
    });

    $(".add-promotion-dropdown-item").click(function () {
        let selected_promotion = $(this).text();
        $("#add-selected-promotion").text(selected_promotion);
    });


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
        let data = {
            productID: productID
        }
        fetch('../../phpFunctions/getProductByID.php', {
            method: 'POST',
            body: JSON.stringify(data),

        }).then(response => response.text()).then(response => {
            let product = JSON.parse(response);
            console.log(product);
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
            $("#detail_imagePreview").attr("src", "../../img/Product/" + product.img_path);


        }).catch(error => console.log(error));
    });


    //DataTable
    var table = $('#myTable').DataTable({
        select: false,
        "columnDefs": [{
            className: "Name",
            "targets": [0],
            "visible": false,
            "searchable": false
        }]
    });//End of create main table
    $('#example tbody').on('click', 'tr', function () {
        alert(table.row(this).data()[0]);

    });


});




