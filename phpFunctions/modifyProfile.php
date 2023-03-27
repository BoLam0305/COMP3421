<?php
include_once('User.php');
include_once('LocalPath.php');
require_once("getDBConnection_bo.php");
// session_start();
// $conn = getDBConnection();
// extract($_SESSION);
// $SQL = "SELECT * FROM `users` WHERE `userID` = '$ID'";
// $result = mysqli_query($conn, $SQL);
// $row = mysqli_fetch_assoc($result);
// echo extract($_POST);

// echo $userName;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fileName = '';
    if (isset($_FILES["file"])) {
        $file = $_FILES["file"];
        $fileName = $file["name"];
        $fileType = $file["type"];
        $fileSize = $file["size"];
        $fileTmpName = $file["tmp_name"];
        $fileName = uniqid() . $fileName;
        move_uploaded_file($fileTmpName, getProfilePath() . $fileName);
    } else {
        $fileName = 'default_profile.jpg';
    }

    $user = new User();
    $user->id = $_POST['userID'];
    $user->userName = $_POST['userName'];
    $user->phone = $_POST['phone'];
    $user->img_path = $fileName;
    echo modify_User($user);
}

function modify_User($user)
{
    $myObj = new stdClass();
    try {
        $conn = getDBConnection();
        $sql = "UPDATE `users` SET `userName`=?, `phone` = ? , `imgPath` = ? WHERE `userID`=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sisi', $user->userName, $user->phone,  $user->img_path,$user->id);
        //$stmt->bind_param("sssiiss", $user->email, $user->password, $user->userName, $user->type, $user->phone, $user->status, $user->img_path);
        $stmt->execute();
        mysqli_close($conn);
        $myObj->status = 'success';
    } catch (Exception $e) {
        $myObj->status = 'fail';
        echo $e;
    }
    return json_encode($myObj);
}

// if (empty($userName) || empty($phone)) {
//     echo $userName;
//     $warning = "Please enter";
//     if (empty($userName)) {
//         $warning .= " Name";
//     }
//     if (empty($phone)) {
//         $warning .= " Phone Number";
//     }
//     header("location:/HTML/User_Page/userProfile.php?Empty=$warning");
// } else {
//     $sql = "UPDATE `users` SET `userName`=?, `phone` = ? WHERE `userID`=?";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param('sii', $userName, $phone,$ID);
//     $stmt->execute();
//     if ($stmt->error) {
//         header("location:/HTML/User_Page/userProfile.php?Empty=Update Failed");
//     }else{
//         mysqli_query($conn, $SQL);
//         mysqli_free_result($result);
//         mysqli_close($conn);
//         $stmt->close();
//         $message = "update success";
//         header("location:/HTML/User_Page/userProfile.php?Empty=$message");
//     }
// }
