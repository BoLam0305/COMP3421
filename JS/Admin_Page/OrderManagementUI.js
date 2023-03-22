$(document).ready(function () {
    $("#voidReason-div").hide();
    // Detail Modal Get Order By ID
    $(".detail-modal-btn").click(function () {
        $("#get-voidReason").text('');
        let orderID = $(this).attr("value");
        var form_data = new FormData();
        form_data.append("order_id", orderID);
        $.ajax({
            url: '../../phpFunctions/getOrderDetailByID.php',
            type: "POST",
            data: form_data,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                let json = JSON.parse(response);

                $("#detail-status").text(json[0].status);
                $("#modal-order-id").text(json[0].orderID);
                $("#detail-userName").text(json[0].userName);
                $("#detail-userID").text(json[0].userID);
                $("#detail-orderDate").text(json[0].orderDate);
                $("#detail-total-text").text(json[0].total);
                $("#detail-item-container").html(createItemHTML(json[0].products));

                if (json[0].voidReason != ''){
                    $("#get-voidReason").text('Void Reason: '+json[0].voidReason);

                }
            }
        });
    });



    function createItemHTML(products) {
        let html = '';
        for (let i = 0; i < products.length; i++) {

            html += '<div>\n' +
                '                            <div>\n' +
                '                                <div>Product Name: <span>' + products[i].productName + '</span></div>\n' +
                '                                <div class="detail-same-row">\n' +
                '                                    <div class="detail-same-row col-10">\n' +
                '                                        <div>Product Category:  <span>' + products[i].category + '</span></div>\n' +
                '                                    </div>\n' +
                '                                    <div class="detail-price-end">' + products[i].Price+ '</div>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>';
        }
        return html;
    }

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

    $(".detail-status-item").click(function () {
       let selected_status = $(this).text();
       $("#detail-status").text(selected_status);

       if (selected_status === 'Void'){
           $("#voidReason-div").show();
       }else{
           $("#voidReason-div").hide();
       }
    });
});