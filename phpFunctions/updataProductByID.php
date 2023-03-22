<?php
include_once('getDBConnection_bo.php');
include_once('Product.php');
date_default_timezone_set('Asia/Hong_Kong');

$_POST = json_decode(file_get_contents('php://input'), true);


$product = new  Product();
$product->id = $_POST['productID'];
$product->Price = $_POST['price'];
$product->Stock = $_POST['stock'];
$product->isPromoted = $_POST['promote'];
$product->status = $_POST['status'];
$product->category = $_POST['category'];
$product->productName = $_POST['productName'];

// $product->id = $productID;
// $product->productName = $productName;
// $product->Price = $Price;
// $product->Stock = $Stock;
// $product->status = $status;
// $product->isPromoted = $product->getIsPromoted($isPromoted);
// $product->category = $category;
// $product->status = $product->getStatus($status);

echo updateProductByID($product);
function updateProductByID($product)
{
    $conn = getDBConnection();
    $arr['msg'] = '';
    try {
        $sql = "UPDATE product 
                SET productName = ?, Price = ?, Stock = ?, status = ?, isPromoted = ?, category = ?
                WHERE productID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siisisi", $product->productName, $product->Price, $product->Stock, $product->status, $product->isPromoted, $product->category, $product->id);
        $stmt->execute();
        mysqli_close($conn);
        $arr['msg'] = 'success';
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        $arr['msg'] = 'fail';
    }

    return $arr['msg'];
}

?>
