<?php
session_start();
require_once("getDBConnection_bo.php");

try{
    if ($_POST['username'] != "" && $_POST['email'] != ""&& $_POST['password'] != ""&& $_POST['password2'] == $_POST['password']&& $_POST['phone'] != "") {
        extract($_POST);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if (password_verify($password, $hashed_password)) {
            echo "Password is valid!";
        } else {
            echo "Password is invalid!";
        }
        
        $icon="";
        $type=0;
        $status="Enable";
        $conn = getDBConnection();
        $sql = "INSERT INTO users (email, password, userName, icon, userTypeID, phone,status)
        VALUES (?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssiis", $email, $hashed_password, $username, $icon, $type, $phone, $status);
        $stmt->execute();
        $stmt->close();
        echo "Sign up success.";
        mysqli_close($conn);
        header("location:/HTML/home.php");
    }
    else if ($_POST['password2'] != $_POST['password']) {
        header("location:/HTML/User_Page/sign_up.php?Empty= Passwords are not the same!");
    }
    else if ($_POST['username'] == "" ) {
        header("location:/HTML/User_Page/sign_up.php?Empty= Name cannot be null! Please input your name.");
    }
    else if ($_POST['email'] == "" ) {
        header("location:/HTML/User_Page/sign_up.php?Empty= Email cannot be null! Please input email.");
    }
    else if ($_POST['password']== "" ) {
        header("location:/HTML/User_Page/sign_up.php?Empty= Password cannot be null! Please input password.");
    }
    else if ($_POST['phone']== "" ) {
        header("location:/HTML/User_Page/sign_up.php?Empty= Phone number cannot be null! Please input your phone number.");
    }
}
catch (Exception $e) {
    echo 'Message: ' .$e->getMessage();
}
?>