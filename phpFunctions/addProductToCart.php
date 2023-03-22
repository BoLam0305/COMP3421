<?php
include 'getDBConnection_bo.php';
include_once ('Product.php');
date_default_timezone_set('Asia/Hong_Kong');

if (session_status() === PHP_SESSION_NONE) {
    // start session if session not start
    session_start();
}

addItemToCart();

function addItemToCart () {
    $productID1 = $_POST['id'];
    $conn = getDBConnection();
    try {
        $stmt = $conn->prepare("SELECT stock, productID FROM product WHERE productID = ?");
        $stmt->bind_param("i", $productID1);
        $stmt->execute();
        $rs = $stmt->get_result();
        $rc = mysqli_fetch_assoc($rs);
        extract($rc);
        $stmt->close();
        mysqli_free_result($rs);
        mysqli_close($conn);

        if($stock == 0) {
            echo "Out of stock";
            return;
        }

        if ($productID1 == $productID && isset($_SESSION['cart'][$productID])) {
            $_SESSION['cart'][$productID]['count'] = $_SESSION['cart'][$productID]['count'] + 1;
        } else if ($productID1 == $productID && !isset($_SESSION['cart'][$productID])) {
            $_SESSION['cart'][$productID]['productID'] = $productID;
            $_SESSION['cart'][$productID]['count'] = 1;
        } else {
            echo "Error when adding your item to the cart";
        }

        echo "Item added to cart";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

//// set product id to session cart
//    $_SESSION['cart'][$productID] = $productID;

}
