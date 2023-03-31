<?php
include_once('getDBConnection_bo.php');
date_default_timezone_set('Asia/Hong_Kong');

if (session_status() === PHP_SESSION_NONE) {
    // start session if session not start
    session_start();
}

doCheckout();

function doCheckout(){
    $error = $orderNotices = $message = array();
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

            // check the available stock of the product
            $checkStock = $conn1->prepare("SELECT stock, productName FROM product WHERE productID = ?");
            $checkStock->bind_param("i", $itemID);
            $checkStock->execute();
            $rs = $checkStock->get_result();
            $rc = mysqli_fetch_assoc($rs);
            extract($rc);
            $checkStock->close();

            // if the order quantity is larger than the available stock
            // set the order quantity to the available stock, and add a notice to the order
            if ($stock < $quantity && $stock > 0) {
                $quantity = $stock;
                $orderNotices['exceedStock'][$itemID]['productName'] = $productName;
                $orderNotices['exceedStock'][$itemID]['Avail_Stock'] = $stock;
            }

            if ($stock == 0) {
                $orderNotices['outOfStock'][$itemID]['productName'] = $productName;
            } else {
                // add the order to the order_product table
                $stmt = $conn1->prepare("INSERT INTO order_product (orderID, productID, qty) VALUES (?, ?, ?)");
                $stmt->bind_param("sss",$orderID, $itemID , $quantity);
                $stmt->execute();
                $stmt->close();

                // reduce the stock of the product
                $reduceStock = $conn1->prepare("UPDATE product SET stock = stock - ? WHERE productID = ?");
                $reduceStock->bind_param("ii", $quantity, $itemID);
                $reduceStock->execute();
                $reduceStock->close();
            }
        }

        mysqli_close($conn1);

        if (isset($orderNotices['outOfStock']) && (count($orderNotices['outOfStock']) == count($cartItems))){
            $message['status'] = 'error';
            $message['message'] = 'All items in your cart are out of stock, this order is not created and you will not be charged';
            $message['action'] = 'redirect';
            $message['actionText'] = 'Return to home page';
        } else {
            $message['message'] = 'Checkout success';
            $message['orderID'] = $orderID;
            $message['orderNotices'] = $orderNotices;
        }

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