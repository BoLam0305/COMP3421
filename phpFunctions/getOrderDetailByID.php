<?php
include_once('getDBConnection_bo.php');
include_once('Order.php');
include_once('getProductsByOrderID.php');
date_default_timezone_set('Asia/Hong_Kong');


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    echo getOrderDetailByID($_POST['order_id']);
}

function getOrderDetailByID($orderID)
{
    $json = '';
    $order_list = array();
    try {
        $conn = getDBConnection();
        $stmt = $conn->prepare("select * from users right join `order` on order.userID = users.userID where order.orderID = ?");
        $stmt->bind_param("i", $orderID);

        $stmt->execute();
        $rs = $stmt->get_result();
        $totalCount = $rs->num_rows;

        // gen Json
        if ($totalCount > 0) {
            while ($rc = mysqli_fetch_assoc($rs)) {
                $order = new Order();
                extract($rc);
                $order->orderID = $orderID;
                $order->userID = $userID;
                $order->userName = $userName;
                $order->orderDate = $orderDate;
                $order->total = $total;
                $order->status = $status;
                $order->voidReason = $voidReason;
                $order_list[] = $order;
                $order->products = getProductsByOrderID($orderID);
            }
        } else {
            $order_list = '';
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
        $json = "false";
    }

    $json = json_encode($order_list, JSON_PRETTY_PRINT);
    return $json;
}

?>