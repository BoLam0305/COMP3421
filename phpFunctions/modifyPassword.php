<?php
session_start();
require_once("getDBConnection_bo.php");
$conn = getDBConnection();
extract($_SESSION);
$SQL = "SELECT * FROM `users` WHERE `userID` = '$ID'";
$result = mysqli_query($conn, $SQL);
$row = mysqli_fetch_assoc($result);
extract($_POST);
if (empty($oPassword) || empty($nPassword) || empty($cPassword)) {
    $warning = "Please enter";
    if (empty($oPassword)) {
        $warning .= " Old Password";
    }
    if (empty($nPassword)) {
        $warning .= " New Password";
    }
    if (empty($cPassword)) {
        $warning .= " Confirm Password";
    }
    header("location:/HTML/User_Page/userProfile.php?EmptyPassword=$warning");
} else {
    /*to confirm the password is same as the database*/
    if ($_POST['oPassword'] == $row['password'] && $nPassword == $cPassword) {
        /*to check is the user wants to change a new password*/
        if ($nPassword == $cPassword && !empty($nPassword)) {
            $sql = "UPDATE `users` SET `password`=? WHERE `userID`=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $nPassword, $ID);
            $stmt->execute();
            if ($stmt->error) {
                header("location:/HTML/User_Page/userProfile.php?EmptyPassword=Update Failed");
            }else{
                mysqli_query($conn, $SQL);
                mysqli_free_result($result);
                mysqli_close($conn);
                $stmt->close();
                $message = "update success";
                header("location:/HTML/User_Page/userProfile.php?EmptyPassword=$message");
            }

        }
    } else if ($_POST['oPassword'] != $row['password']) {
        $warning .= "The Password is wrong!";
        header("location:/HTML/User_Page/userProfile.php?EmptyPassword=$warning");
    } else if ($nPassword != $cPassword) {
        $warning .= "Make Sure New and Confirm Password are same!";
        header("location:/HTML/User_Page/userProfile.php?EmptyPassword=$warning");
    }
}
