<?php
include_once('getDBConnection_bo.php');
include_once('Product.php');
include_once('LocalPath.php');

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
        echo "File uploaded successfully.";
    } else {
        $fileName = 'default_product.png';
    }


    $product = new Product();
    $product->productName = $_POST['productName'];
    $product->Price = $_POST['productPrice'];
    $product->Stock = $_POST['productStock'];
    $product->status = $_POST['productStatus'];
    $product->isPromoted = $_POST['productPromotion'];
    $product->category = $_POST['productCategory'];
    $product->img_path = $fileName;


   echo add_product($product);
}


function add_product($product){
    $myObj = new stdClass();
    try{
        $conn = getDBConnection();
        $sql = "INSERT INTO product (productName, Price, Stock, status, isPromoted, category, img_path)
        VALUES (?,?,?,?,?,?,?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siisiss", $product->productName,
            $product->Price, $product->Stock, $product->status, $product->isPromoted, $product->category, $product->img_path);
        $stmt->execute();
        mysqli_close($conn);
        $myObj->status = 'success';
    }catch (Exception $e){
        $myObj->status = 'fail';
        echo $e;
    }
    return json_encode($myObj);

}
?>