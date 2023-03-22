<?php
error_reporting(-1);

session_start();

include 'getDBConnection_bo.php';
date_default_timezone_set('Asia/Hong_Kong');
getAllProducts();

function getAllProducts()
{
    $count = 0;
    $products[$count] = array();
    $conn = getDBConnection();

    try{
        $sql = "SELECT * FROM product";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $rs = $stmt->get_result();

        $totalCount = $rs->num_rows;

        if ($totalCount > 0) {
            while ($rc = mysqli_fetch_assoc($rs)) {
                $stockLevel = setProductStockStatus($rc['Stock']);

                $products[$count]['productID'] = $rc['productID'];
                $products[$count]['productName'] = $rc['productName'];
                $products[$count]['Price'] = $rc['Price'];
                $products[$count]['isPromoted'] = $rc['isPromoted'];
                $products[$count]['category'] = $rc['category'];
                $products[$count]['Stock'] = $stockLevel;
                $products[$count]['isPromoted'] = $rc['isPromoted'];
                $products[$count]['productImage'] = $rc['icon'];
                $count++;
            }
        } else {
            $products = '';
        }

        mysqli_free_result($rs);
        mysqli_close($conn);

        header('Content-Type: application/json;');

        $json = json_encode($products, JSON_PRETTY_PRINT);
        echo $json == "";

        if ($json !== "") {
            echo $json;
        } else {
            $noProducts = array();
            $noProducts['error'] = 'No products found';
            echo json_encode($noProducts, JSON_PRETTY_PRINT);
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function setProductStockStatus($stock){
    if ($stock > 0) {
        if ($stock < 10) {
            return 'Low Stock';
        } else {
            return 'In Stock';
        }
    } else {
        return 'Sold Out';
    }
}
