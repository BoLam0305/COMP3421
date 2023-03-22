<?php
include_once('getDBConnection_bo.php');
include_once('User.php');
date_default_timezone_set('Asia/Hong_Kong');


if ($_POST['method'] == 'checkName') {
    echo checkNameIsExist($_POST['value'], $_POST['productID']);
}

function checkNameIsExist($name, $formProductID)
{
    $conn = getDBConnection();

    $myObj = new stdClass();
    try {
        $stmt = $conn->prepare("SELECT * FROM product WHERE productName = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $rs = $stmt->get_result();
        if ($rs->num_rows > 0) {
            $rc = mysqli_fetch_assoc($rs);
            extract($rc);
            if ($formProductID != $productID) {
                $myObj->status = 'fail';
                $myObj->msg = 'sorry this product name is already used';
            } else {
                $myObj->status = 'success';
            }
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