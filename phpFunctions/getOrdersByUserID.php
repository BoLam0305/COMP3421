<?php
include_once('getDBConnection_bo.php');
include_once ('Product.php');
include_once('Order.php');
function get_all_products_bu_userID($userID){
    $json = '';
    $order_list = array();
    try{
        $conn = getDBConnection();
        $sql = "select * from `order` where userID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();

        $rs = $stmt->get_result();
        $totalCount = $rs->num_rows;

//
//        // print all the results
//        while ($row = $rs->fetch_assoc()) {
//            print_r($row);
//        }
        // gen Json
        if ($totalCount > 0) {
            while ($rc = mysqli_fetch_assoc($rs)) {
                $order = new Order();
                extract($rc);
                $order->orderID = $orderID;
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
