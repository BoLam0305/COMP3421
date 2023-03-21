<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order History</title>

    <!--local CSS-->
    <link href="../../CSS/Admin_Page/left-menu.css" rel="stylesheet">
    <link href="../../CSS/Admin_Page/right-management.css" rel="stylesheet">
    <link href="../../CSS/Admin_Page/add_modam.css" rel="stylesheet">

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css"/>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <!--local Js-->
    <script src="../../JS/OrderHistoryUI.js"></script>

    <!--Bosstrap-->
    <script src="https://kit.fontawesome.com/ceae024db6.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<div>Menu-bar</div>
<div id="main-container" class="row">
    <div id="right-content" class="col-12">
        <div class="container">
            <table class="table caption-top table-hover" id="myTable">
                <div id="table-header">
                    <div>Order Management</div>
                </div>
                <thead>
                <tr>
                    <th scope="col">#Order　ID</th>
                    <th scope="col"><i class="fas fa-calendar-alt"></i>Order-Date</th>
                    <th scope="col">$ Total</th>
                    <th scope="col">Status</th>
                    <th scope="col">Details</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include_once('../../phpFunctions/getOrdersByUserID.php');
                $orders = json_decode(get_all_products_bu_userID(88), false);
                for ($i = 0; $i < count($orders); $i++) {
                    echo '<tr>';
                    echo ' <td class="align-middle">' . $orders[$i]->orderID . '</td>';
                    echo ' <td class="align-middle">' . $orders[$i]->orderDate . '</td>';
                    echo ' <td class="align-middle">' . $orders[$i]->total . '</td>';
                    echo ' <td class="align-middle">' . $orders[$i]->status . '</td>';
                    echo '<td class="align-middle"><button value="' . $orders[$i]->orderID . '" class="btn btn-warning detail-modal-btn" data-bs-toggle="modal" data-bs-target="#detailModal">View</button></td>';
                    echo '</tr>';
                }
                ?>
            </table>
        </div>

    </div>
</div>
</div>
<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Detail #<span id="modal-order-id"></span></h5>
                <p id="detail-status">Status</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-form">
                <div id="detail_img_name" style="display: none"></div>
                <div class="row">
                    <p><i class='fas fa-calendar-check'></i>Order Date: <span id="detail-orderDate"></span></p>
                </div>
                <div class="row">
                    <h5><i class='fas fa-hamburger'></i>Items:</h5>
                    <div class="detail-item-container-header">$Price</div>
                    <div id="detail-item-container"></div>
                    <div id="detail-total">Total: <span id="detail-total-text"></span></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
</body>

</html>