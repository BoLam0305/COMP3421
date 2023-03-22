<?php
include_once('getDBConnection_bo.php');
include_once('Order.php');
date_default_timezone_set('Asia/Hong_Kong');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order = new Order();
    $order->status = $_POST['status'];
    $order->voidReason = $_POST['voidReason'];
    $order->orderID = $_POST['orderID'];
    echo json_encode($order);
    echo updateOrderStatus($order);
}
function updateOrderStatus($order){
    $conn = getDBConnection();
    $myObj = new stdClass();
    try{
        $sql = "UPDATE `order`
                SET status = ?, voidReason = ?
                WHERE orderID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $order->status, $order->voidReason, $order->orderID);
        $stmt->execute();
        mysqli_close($conn);
        $myObj->status = 'success';
    }catch (Exception $e){
        echo "Error: " . $e->getMessage();

        $myObj->status = 'fail';
    }

    return json_encode($myObj);
}
?>