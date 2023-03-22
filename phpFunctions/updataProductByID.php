<?php
include_once('getDBConnection_bo.php');
include_once('Product.php');
date_default_timezone_set('Asia/Hong_Kong');

$_POST = json_decode(file_get_contents('php://input'), true);


$product = new  Product();
$product->id = $_POST['userID'];
$product->Price = $_POST['email'];
$product->Stock = $_POST['userName'];
$product->isPromoted = $_POST['phone'];
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
echo json_encode($product);

// echo updateUserByID($product);
function updateProductByID($product)
{
    $conn = getDBConnection();
    $arr['msg'] = '';
    try {
        $sql = "UPDATE users 
                SET email = ?, userName = ?, icon = ?, phone = ?, status = ?
                WHERE userID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssisi", $product->email, $product->userName, $product->icon, $product->phone, $product->status, $product->id);
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
