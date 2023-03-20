<?php
include_once('getDBConnection_bo.php');
include_once('User.php');
date_default_timezone_set('Asia/Hong_Kong');


if ($_POST['method'] == 'checkEmailIsExist') {
    echo checkEmailIsExist($_POST['value'], $_POST['formUserID']);
} else if ($_POST['method'] == 'checkPhone') {
    echo checkPhoneIsExist($_POST['value'], $_POST['formUserID']);
}


function checkEmailIsExist($email, $formUserID)
{
    $pattern = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@connect.polyu.hk/';
    $count = preg_match($pattern, $email);
    $myObj = new stdClass();
    if ($count == 0) {
        $myObj->status = 'fail';
        $myObj->msg = 'sorry we only accept polyu students and staff';
    } else {
        $conn = getDBConnection();
        $myObj = new stdClass();
        try {
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $rs = $stmt->get_result();
            if ($rs->num_rows > 0) {
                $rc = mysqli_fetch_assoc($rs);
                extract($rc);
                if ($formUserID != $userID) {
                    $myObj->status = 'fail';
                    $myObj->msg = 'sorry this user name is already used';
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
    }

    return json_encode($myObj, JSON_PRETTY_PRINT);
}

function checkPhoneIsExist($phone, $formUserID)
{
    $conn = getDBConnection();

    $myObj = new stdClass();
    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE phone = ?");
        $stmt->bind_param("i", $phone);
        $stmt->execute();
        $rs = $stmt->get_result();
        if ($rs->num_rows > 0) {
            $rc = mysqli_fetch_assoc($rs);
            extract($rc);
            if ($formUserID != $userID) {
                $myObj->status = 'fail';
                $myObj->msg = 'sorry this phone number is already used';
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