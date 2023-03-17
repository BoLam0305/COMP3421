<?php
session_start();
require_once("getDBConnection.php");
$conn = getDBConnection();
if ($_POST['email'] != "" && $_POST['password'] != "") {
    extract($_POST);
    $SQL = "SELECT * FROM `users` WHERE `email` = '$email' and `password` = '$password'";
    $result = mysqli_query($conn, $SQL);
    $row = mysqli_fetch_array($result);
    echo $row['email'];
    echo $row['password'];
    if ($row['userTypeID' == 0]) {
        $_SESSION['ID'] = $row['userID'];
        $_SESSION['email'] = $email;
        $_SESSION['Identity'] = "customer";
        header("location:/HTML/homehome.php");
    } else if ($row['userTypeID' == 1]) {
        // $SQL = "SELECT * FROM `tenant` WHERE `tenantID` = '$ID' and `password` = '$password'";
        // $result = mysqli_query($conn,$SQL);
        // $row = mysqli_fetch_array($result);
        $_SESSION['ID'] = $row['userID'];
        $_SESSION['email'] = $email;
        $_SESSION['Identity'] = "admin";
        header("location:/HTML/Admin_Page/adminPage.php");
    } else {
        header("location:/HTML/User_Page/login.php?Empty= Incorrect Email/ID or Password");
    }
} else {
    header("location:/HTML/User_Page/login.php?Empty= Please input Email/ID or Password");
}
mysqli_close($conn);
