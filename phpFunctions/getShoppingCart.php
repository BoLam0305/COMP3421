<?php
include 'getDBConnection_bo.php';
include_once('Product.php');
date_default_timezone_set('Asia/Hong_Kong');

if (session_status() === PHP_SESSION_NONE) {
    // start session if session not start
    session_start();
}

getShoppingCartItems();

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

    echo json_encode($cartItems, JSON_PRETTY_PRINT);
}

function getItemsDetailsByID($id){
    $queriedItem = array();
    $conn = getDBConnection();
    try {
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