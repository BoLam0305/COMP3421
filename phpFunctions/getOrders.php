<?php
include_once ('getDBConnection_bo.php');
include_once ('Order.php');
date_default_timezone_set('Asia/Hong_Kong');

get_all_products();

function get_all_products(){
    $json = '';
    $order_list = array();
    try{
        $conn = getDBConnection();
        $sql = "select * from users right join `order` on order.userID = users.userID";
        $stmt = $conn->prepare($sql);
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
                $order_list[] = $order;
            }
        } else {
            $order_list = '';
        }
    }catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
        $json = "false";
    }

    $json = json_encode($order_list, JSON_PRETTY_PRINT);
    return $json;

}

?>
