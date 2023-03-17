<?php
include_once('getDBConnection_bo.php');
include_once('User.php');
date_default_timezone_set('Asia/Hong_Kong');

$_POST = json_decode(file_get_contents('php://input'), true);


$user = new  User();
$user->id = $_POST['userID'];
$user->email = $_POST['email'];
$user->userName = $_POST['userName'];
$user->phone = $_POST['phone'];
$user->status = $_POST['status'];

echo updateUserByID($user);
function updateUserByID($user)
{
    $conn = getDBConnection();
    $arr['msg'] = '';
    try {
        $sql = "UPDATE users 
                SET email = ?, userName = ?, icon = ?, phone = ?, status = ?
                WHERE userID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssisi", $user->email, $user->userName, $user->icon, $user->phone, $user->status, $user->id);
        $stmt->execute();
        mysqli_close($conn);
        $arr['msg'] = 'success';
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        $arr['msg'] = 'fail';
    }

    return $arr['msg'];
}

?>
