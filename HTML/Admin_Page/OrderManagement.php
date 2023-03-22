<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Management</title>

    <!--local CSS-->
    <link href="../../CSS/Admin_Page/left-menu.css" rel="stylesheet">
    <link href="../../CSS/Admin_Page/right-management.css" rel="stylesheet">
    <link href="../../CSS/Admin_Page/add_modam.css" rel="stylesheet">

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css"/>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>


    <!--Bosstrap-->
    <script src="https://kit.fontawesome.com/ceae024db6.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--local Js-->
    <script src="../../JS/Admin_Page/OrderManagementUI.js"></script>
    <script src="../../JS/Admin_Page/updateOrderVaildation.js"></script>


</head>
<body>
<div>Menu-bar</div>
<div id="main-container" class="row">
    <div class="col-2 h-100" id="left-menu">
        <div class="row-3"><a href="./ProductManagement.php">Menu Management</a></div>
        <div class="row-3 left-menu-target"><a href="./OrderManagement.php">Order Management</a> </div>
        <div class="row-3"><a href="./UserManagement.php">User Management</a></div>
    </div>
    <div id="right-content" class="col-10">
        <div class="container">
            <table class="table caption-top table-hover" id="myTable">
                <div id="table-header">
                    <div>Order Management</div>
                </div>
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">#ID</th>
                    <th scope="col"><i class="fas fa-user"></i>Buyer ID</th>
                    <th scope="col"><i class="fas fa-user"></i>Buyer</th>
                    <th scope="col">$ Price</th>
                    <th scope="col"><i class="fas fa-calendar-alt"></i>Order-Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Details</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include_once('../../phpFunctions/getOrders.php');
                $orders = json_decode(get_all_products(), false);
                for ($i = 0; $i < count($orders); $i++) {
                    echo '<tr>';
                    echo ' <td class="align-middle">' . $orders[$i]->orderID . '</td>';
                    echo ' <td class="align-middle">' . $orders[$i]->orderID . '</td>';
                    echo ' <td class="align-middle">' . $orders[$i]->userID . '</td>';
                    echo ' <td class="align-middle">' . $orders[$i]->userName . '</td>';
                    echo ' <td class="align-middle">' . $orders[$i]->total . '</td>';
                    echo ' <td class="align-middle">' . $orders[$i]->orderDate . '</td>';
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-form">
                <div id="detail_img_name" style="display: none"></div>
                <div class="row">
                    <div class="row">
                        <p class="col"><i class="fas fa-user"></i>Buyer: <span id="detail-userName"></span>(#<span
                                    id="detail-userID"></span>)</p>
                        <div class="col text-end">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="detail-status"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown button
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item detail-status-item" href="#">Complete</a></li>
                                    <li><a class="dropdown-item detail-status-item" href="#">In Progress</a></li>
                                    <li><a class="dropdown-item detail-status-item" href="#">Void</a></li>
                                </ul>
                            </div>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <p id="get-voidReason"></p>
                    </div>
                    <div class="row" id="voidReason-div">
                        <p>Reason</p>
                        <div><input type="text" id="voidReason"></div>
                        <div id="voidReason-msg"></div>
                    </div>
                    <div class="row">
                        <p><i class='fas fa-calendar-check'></i>Order Date: <span id="detail-orderDate"></span></p>
                    </div>
                    <div class="row">
                        <p><i class='fas fa-hamburger'></i>Items:</p>
                        <div class="detail-item-container-header">$Price</div>
                        <div id="detail-item-container"></div>
                        <div id="detail-total">Total: <span id="detail-total-text"></span></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="detain-save-btn">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>