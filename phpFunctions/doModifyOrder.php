<?php
include 'getDBConnection_bo.php';
date_default_timezone_set('Asia/Hong_Kong');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

modifyCartItems();

function modifyCartItems () {
    $action = $_POST['action'];
    $productID = $_POST['productID'];

    try {
        if ($action == 'increase') {
            if (isset($_SESSION['cart'][$productID])) {
                $_SESSION['cart'][$productID]['count']++;
            }
        } else if ($action == 'decrease') {
            if (isset($_SESSION['cart'][$productID])) {
                $_SESSION['cart'][$productID]['count']--;

                if ($_SESSION['cart'][$productID]['count'] == 0) {
                    unset($_SESSION['cart'][$productID]);
                }
            }
        } else if ($action == 'remove') {
            if (isset($_SESSION['cart'][$productID])) {
                unset($_SESSION['cart'][$productID]);
            }
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()], JSON_PRETTY_PRINT);
        exit;
    }

    echo json_encode(['status' => 'success'], JSON_PRETTY_PRINT);
}