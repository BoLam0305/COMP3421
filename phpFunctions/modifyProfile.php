<?php
session_start();
require_once("getDBConnection_bo.php");
$conn = getDBConnection();
extract($_SESSION);
$SQL = "SELECT * FROM `users` WHERE `userID` = '$ID'";
$result = mysqli_query($conn, $SQL);
$row = mysqli_fetch_assoc($result);
echo extract($_POST);

if (empty($userName) || empty($phone)) {
    echo $userName;
    $warning = "Please enter";
    if (empty($userName)) {
        $warning .= " Name";
    }
    if (empty($phone)) {
        $warning .= " Phone Number";
    }
    // header("location:/HTML/User_Page/userProfile.php?Empty=$warning");
} else {
    $sql = "UPDATE `users` SET `userName`=?, `phone` = ? WHERE `userID`=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sii', $userName, $phone,$ID);
    $stmt->execute();
    if ($stmt->error) {
        header("location:/HTML/User_Page/userProfile.php?Empty=Update Failed");
    }else{
        mysqli_query($conn, $SQL);
        mysqli_free_result($result);
        mysqli_close($conn);
        $stmt->close();
        $message = "update success";
        // header("location:/HTML/User_Page/userProfile.php?Empty=$message");
    }
}
