<?php
include_once('getDBConnection_bo.php');
include_once('Product.php');
include_once('LocalPath.php');
date_default_timezone_set('Asia/Hong_Kong');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fileName = '';
    if (isset($_FILES["file"])) {
        $file = $_FILES["file"];
        $fileName = $file["name"];
        $fileType = $file["type"];
        $fileSize = $file["size"];
        $fileTmpName = $file["tmp_name"];
        $fileName = uniqid() . $fileName;
        move_uploaded_file($fileTmpName, getProductPath() . $fileName);
    } else {
        $fileName = 'default_product.png';
    }

    $product = new  Product();
    $product->id = $_POST['productID'];
    $product->Price = $_POST['price'];
    $product->Stock = $_POST['stock'];
    $product->isPromoted = $_POST['promote'];
    $product->status = $_POST['status'];
    $product->category = $_POST['category'];
    $product->productName = $_POST['productName'];
    $product->img_path = $fileName;
    echo updateProductByID($product);
}





// $product->id = $productID;
// $product->productName = $productName;
// $product->Price = $Price;
// $product->Stock = $Stock;
// $product->status = $status;
// $product->isPromoted = $product->getIsPromoted($isPromoted);
// $product->category = $category;
// $product->status = $product->getStatus($status);


function updateProductByID($product)
{
    $conn = getDBConnection();
    $myObj = new stdClass();
    try {
        $sql = "UPDATE product 
                SET productName = ?, Price = ?, Stock = ?, status = ?, isPromoted = ?, category = ?, img_path = ?
                WHERE productID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siisissi", $product->productName, $product->Price, $product->Stock, $product->status, $product->isPromoted, $product->category, $product->img_path,$product->id);
        $stmt->execute();
        mysqli_close($conn);
        $myObj->status = 'success';
    } catch (Exception $e) {
        $myObj->status = 'fail';
    }

    return json_encode($myObj);
}

?>
