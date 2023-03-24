loadOrders();

var content = '';
function loadOrders() {
    var orders;
    content = '';
    fetch('../../phpFunctions/getOrders.php', {
        method: 'POST',

    }).then(response => response.json()).then(async (response) => {
        orders = response;
        orders.forEach(order => {
            console.log(order.orderID);
            loadOrder(order.orderID)
        });
    });

}

function loadOrder(ID) {
    var form_data = new FormData();
    form_data.append("order_id", ID);
    $.ajax({
        url: '../../phpFunctions/getOrderDetailByID.php',
        type: "POST",
        data: form_data,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response);
            let json = JSON.parse(response);

            json.forEach(order => {
                console.log(order.status);
                if (order.status != "Complete") {
                    content += `
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    Order#${order.orderID}
                                    <button type="button" class="btn btn-success float-end" id="completeBtn" value="${order.orderID}" onclick="completeOrder(this)">Complete</button>
                                </div>
                                <ul class="list-group list-group-flush">
                                `
                    order.products.forEach(product => {
                        console.log(product.productName);
                        content += `
                                    <li class="list-group-item">${product.productName}</li>
                            `
                    });
                    content += `
                                </ul>
                            </div>
                        </div>
                        `;
                }
            });

            $(".orders").html(content);
        }
    });

}

