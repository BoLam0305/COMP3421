$(document).ready(function () {
    $("#completeBtn").click(function () {
        console.log($(this).val(''));

        var form_data = new FormData();
        form_data.append('orderID', $(this).val(''));
        fetch('../../phpFunctions/completeOrder.php', {
            method: 'POST',
            body: form_data
        }).then(response => response.text()).then(async (response) => {
            console.log(response);
        });
        // let selected_status = $("#detail-status").text();
        // let voidReason = $("#voidReason").val();
        // let orderID = $("#modal-order-id").text();

        // console.log(selected_status);
        // console.log(voidReason);
        // console.log(orderID);
        // if (updateFormValidation(selected_status, voidReason)) {
        //     var form_data = new FormData();
        //     form_data.append('status', selected_status);
        //     form_data.append('voidReason', voidReason);
        //     form_data.append('orderID', orderID);

        //     // Get the foods from the database
        //     fetch('../../phpFunctions/updateOrderStatus.php', {
        //         method: 'POST',
        //         body: form_data
        //     }).then(response => response.text()).then(async (response) => {
        //         console.log(response);
        //     });
        // }
    });

});