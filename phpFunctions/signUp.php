<?php
session_start();
require_once("getDBConnection_bo.php");
$conn = getDBConnection();

try{
if ($_POST['username'] != "" && $_POST['email'] != ""&& $_POST['password'] != ""&& $_POST['password2'] = $_POST['password']&& $_POST['phone'] != "") {
    extract($_POST);
    $stmt= $conn->prepare("SELECT Count(*) FROM `users` WHERE `email` = ?");
    $stmt->bind_param("i", $email);
    if (! $stmt->execute()) {
        trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
    }
    $count = null;
    $stmt->bind_result($count);
    if ($count != 0) {
        echo "Already sign up before.";
    }
    $stmt->close();
    else{
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, userTypeID, phone) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssii", $username, $email, $password, 2, $phone);
    $stmt->execute();
    $stmt->close();
    echo "Sign up success."
    }
    mysqli_close($conn);
}
}
catch (Exception $e) {
    echo 'Message: ' .$e->getMessage();
}
?>