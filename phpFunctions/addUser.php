<?php
include_once('getDBConnection_bo.php');
include_once('User.php');
date_default_timezone_set('Asia/Hong_Kong');

$_POST = json_decode(file_get_contents('php://input'), true);


$user = new User();
$user->email = $_POST['email'];
$user->password = $_POST['password'];
$user->userName = $_POST['userName'];
$user->phone = $_POST['phone'];
$user->setType($_POST['userType']);
$user->status = $_POST['status'];
$user->icon = $_POST['icon'];

add_user($user);


function add_user($user)
{
    $conn = getDBConnection();
    $sql = "INSERT INTO users (email, password, userName, icon, userTypeID, phone,status)
        VALUES (?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiis", $user->email, $user->password, $user->userName, $user->icon, $user->type, $user->phone, $user->status);
    $stmt->execute();
    mysqli_close($conn);

}


?>