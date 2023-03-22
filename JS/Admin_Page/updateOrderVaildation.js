$(document).ready(function () {
    $("#detain-save-btn").click(function () {
        let selected_status = $("#detail-status").text();
        let voidReason = $("#voidReason").val();
        let orderID = $("#modal-order-id").text();

        console.log(selected_status);
        console.log(voidReason);
        console.log(orderID);
        var form_data = new FormData();
        form_data.append('status', selected_status);
        form_data.append('voidReason', '');
        form_data.append('orderID', orderID);
        $.ajax({
            type: "POST",
            url: '../../phpFunctions/updateOrderStatus.php',
            data: form_data,
            success: function (response) {
                console.log(response);
            }
        });
    });
    // $("#detain-save-btn").click(function () {
    //
    //     let selected_status = $("#detail-status").text();
    //     let voidReason = $("#voidReason").val();
    //     let orderID = $("#modal-order-id").text();
    //     if (updateFormValidation(selected_status, voidReason)) {
    //         console.log('sad');
    //         var form_data = new FormData();
    //         form_data.append('status', selected_status);
    //         form_data.append('voidReason', voidReason);
    //         form_data.append('orderID', orderID);
    //         $.ajax({
    //             type: "POST",
    //             url: '../../phpFunctions/updateOrderStatus.php',
    //             data: form_data,
    //             success: function (response) {
    //                 console.log(response);
    //             }
    //         });
    //
    //     }
    //
    // });
    //
    //
    // function updateFormValidation(selected_status, voidReason) {
    //     let form = true;
    //     if (selected_status === 'Void') {
    //         if (voidReason === '') {
    //             $("#voidReason-msg").text('please enter a void reason');
    //             form = false;
    //         }
    //     }
    //     return form;
    // }
});