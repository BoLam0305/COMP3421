$(document).ready(function () {

    $("#add-btn").click(function () {
        let file = document.getElementById("logo").files[0];
        let productName = $("#productName").text();
        let productPrice = $("#productPrice").text();
        let productCategory = $("#selected-category").text();
        let stock = 1;

        var form_data = new FormData();
        // form_data.append("productName", productName);
        // form_data.append("Price", productPrice);
        // form_data.append("Stock", stock);
        // form_data.append("status", productStatus);
        // form_data.append("category", productCategory);
        // form_data.append("file", file);
    });


});