<?php
include_once('getDBConnection_bo.php');
date_default_timezone_set('Asia/Hong_Kong');

if (session_status() === PHP_SESSION_NONE) {
    // start session if session not start
    session_start();
}

doCheckout();

function doCheckout(){
    $error = array();
    $userID = $_SESSION['ID'];
    $orderDate = date("Y-m-d H:i:s");
    $paymentMethod = $_POST['method'];
    $cartItems = getShoppingCartItems();

    // check if paymentMethod is valid
    if ($paymentMethod == '') {
        $error['error'] = 'Please select a payment method';
        echo json_encode($error, JSON_PRETTY_PRINT);
        return;
    } else if ($paymentMethod !== 'visa' && $paymentMethod !== 'master') {
        $error['error'] = 'Invalid payment method';
        echo json_encode($error, JSON_PRETTY_PRINT);
        return;
    }

    // check if cart is empty
    if (count($cartItems) == 0) {
        $error['error'] = 'No items in cart';
        echo json_encode($error, JSON_PRETTY_PRINT);
        return;
    }

    // calculate total price
    $totalPrice = 0;
    foreach ($cartItems as $item) {
        $totalPrice += $item['totalPrice'];
    }

    // insert order into database
    try {
        $conn = getDBConnection();
        $stmt = $conn->prepare("INSERT INTO `order` (userID, orderDate, total) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $userID, $orderDate, $totalPrice);
        $stmt->execute();
        $stmt->close();

        // get orderID
        $orderID = mysqli_insert_id($conn);
        mysqli_close($conn);

        foreach ($cartItems as $item) {
            $conn1 = getDBConnection();
            $itemID = $item['productID'];
            $quantity = $item['quantity'];

            $stmt = $conn1->prepare("INSERT INTO order_product (orderID, productID, qty) VALUES (?, ?, ?)");
            $stmt->bind_param("sss",$orderID, $itemID , $quantity);
            $stmt->execute();
            $stmt->close();
        }

        mysqli_close($conn1);
        $message['message'] = 'Checkout success';
        $message['orderID'] = $orderID;

        foreach ($cartItems as $item) {
            $itemID = $item['productID'];
            unset($_SESSION['cart'][$itemID]);
        }

        echo json_encode($message, JSON_PRETTY_PRINT);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

function getShoppingCartItems(){
    $cartItems = array();
    $idx = 0;
    foreach ($_SESSION['cart'] as $item) {
        $itemID = $item['productID'];
        $item = getItemsDetailsByID($itemID);

        $cartItems[$idx]['productID'] = $item['productID'];
        $cartItems[$idx]['productName'] = $item['productName'];
        $cartItems[$idx]['quantity'] = $_SESSION['cart'][$itemID]['count'];
        $cartItems[$idx]['totalPrice'] = $item['price'] * $_SESSION['cart'][$itemID]['count'];
        $idx++;
    }

    if (count($cartItems) == 0) {
        $cartItems['error'] = 'No items in cart';
    }

    return $cartItems;
}

function getItemsDetailsByID($id){
    $queriedItem = array();
    try {
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT productID, productName, Price FROM product WHERE productID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $rs = $stmt->get_result();
        $rc = mysqli_fetch_assoc($rs);
        extract($rc);
        $stmt->close();
        mysqli_free_result($rs);
        mysqli_close($conn);

        $queriedItem['productID'] = $productID;
        $queriedItem['productName'] = $productName;
        $queriedItem['price'] = $Price;

        return $queriedItem;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}