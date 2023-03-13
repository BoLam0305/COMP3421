<?php
include 'getDBConnection.php';

$productID = $_POST['productID'];

$conn = getDBConnection();

try {
    $stmt = $conn -> prepare("SELECT icon FROM product WHERE productID = ?");
    $stmt -> bind_param("s", $productID);

    $stmt -> execute();

    $rs = $stmt -> get_result();

    $rc = mysqli_fetch_assoc($rs);
    extract($rc);

    $stmt->close();

    mysqli_free_result($rs);
    mysqli_close($conn);

    echo $icon;

} catch (Exception $e) {
    echo "Error: " . $e -> getMessage();
}