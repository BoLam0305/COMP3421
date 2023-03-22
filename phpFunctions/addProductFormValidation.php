<?php
include_once('getDBConnection_bo.php');
date_default_timezone_set('Asia/Hong_Kong');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['method'] == 'checkProductIsExist') {
        echo checkProductIsExist($_POST['value']);
    }


}


function checkProductIsExist($productName)
{
    $conn = getDBConnection();
    $myObj = new stdClass();

    try {
        $stmt = $conn->prepare("SELECT * FROM product WHERE productName = ?");
        $stmt->bind_param("s", $productName);
        $stmt->execute();
        $rs = $stmt->get_result();
        if ($rs->num_rows > 0) {
            $myObj->status = 'fail';
            $myObj->msg = 'sorry this product name is already used';
        } else {
            $myObj->status = 'success';
        }
        $stmt->close();
        mysqli_close($conn);

    } catch (Exception $e) {
        $myObj->status = 'fail';
        echo "Error: " . $e->getMessage();
    }

    return json_encode($myObj, JSON_PRETTY_PRINT);

}


?>
