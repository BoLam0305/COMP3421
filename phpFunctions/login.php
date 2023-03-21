<?php
session_start();
require_once("getDBConnection_bo.php");
$conn = getDBConnection();
echo $_POST['email'];
echo $_POST['password'];

if ($_POST['email'] != "" && $_POST['password'] != "") {
    $_STATEMENT = $conn->prepare("SELECT * FROM users WHERE email = ? and `password` = ?;");
    $_STATEMENT->bind_param('ss', $_POST['email'], $_POST['password']);
    $_STATEMENT->execute();
    $result = $_STATEMENT->get_result();
    if ($result->num_rows == 1) {
        $result = $result->fetch_array();
        $_STATEMENT->free_result();
        $_STATEMENT->close();
        extract($result);
        mysqli_close($conn);
        if ($status != "Disable") {
            if ($userTypeID == 0) {
                $_SESSION['ID'] = $userID;
                $_SESSION['email'] = $email;
                $_SESSION['Identity'] = "user";
                echo $_SESSION['email'];
                header("location:/HTML/home.php");
            } else if ($userTypeID == 1) {
                // $SQL = "SELECT * FROM `tenant` WHERE `tenantID` = '$ID' and `password` = '$password'";
                // $result = mysqli_query($conn,$SQL);
                // $row = mysqli_fetch_array($result);
                $_SESSION['ID'] = $userID;
                $_SESSION['email'] = $email;
                $_SESSION['Identity'] = "admin";
                header("location:/HTML/Admin_Page/ProductManagement.php");
            } else {
                header("location:/HTML/User_Page/login.php?Empty= Incorrect Email/ID or Password");
            }
        } else {
            header("location:/HTML/User_Page/login.php?Empty= Your account has been disabled");
        }
    } else {
        header("location:/HTML/User_Page/login.php?Empty= Invalid email or password");
    }
}
