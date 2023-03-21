<?php
include_once('getDBConnection_bo.php');
include_once('Product.php');
date_default_timezone_set('Asia/Hong_Kong');

$_POST = json_decode(file_get_contents('php://input'), true);

echo getProductByID($_POST['productID']);


function getProductByID($productID)
{
    $product = new Product();
    $conn = getDBConnection();
    try {
        $stmt = $conn->prepare("SELECT * FROM product WHERE productID = ?");
        $stmt->bind_param("i", $productID);
        $stmt->execute();
        $rs = $stmt->get_result();
        $rc = mysqli_fetch_assoc($rs);
        extract($rc);
        $stmt->close();
        mysqli_free_result($rs);
        mysqli_close($conn);

        $product->id = $productID;
        $product->productName = $productName;
        $product->Price = $Price;
        $product->Stock = $Stock;
        $product->status = $status;
        $product->isPromoted = $product->getIsPromoted($isPromoted);
        $product->category = $category;
        $product->status = $product->getStatus($status);

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    return json_encode($product, JSON_PRETTY_PRINT);

}
