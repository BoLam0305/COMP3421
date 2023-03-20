<?php
session_start();
require_once("getDBConnection_bo.php");

try{
    if ($_POST['username'] != "" && $_POST['email'] != ""&& $_POST['password'] != ""&& $_POST['password2'] = $_POST['password']&& $_POST['phone'] != "") {
        extract($_POST);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if (password_verify($password, $hashed_password)) {
            echo "Password is valid!";
        } else {
            echo "Password is invalid!";
        }
        
        $icon="";
        $type=0;
        $status="Disable";
        $conn = getDBConnection();
        $sql = "INSERT INTO users (email, password, userName, icon, userTypeID, phone,status)
        VALUES (?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssiis", $email, $hashed_password, $username, $icon, $type, $phone, $status);
        $stmt->execute();
        $stmt->close();
        echo "Sign up success.";
    }
    mysqli_close($conn);
}
catch (Exception $e) {
    echo 'Message: ' .$e->getMessage();
}
?>