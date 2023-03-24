<?php
include_once('getDBConnection_bo.php');
include_once('User.php');
include_once('LocalPath.php');
date_default_timezone_set('Asia/Hong_Kong');

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
        echo "File uploaded successfully.";
    } else {
        $fileName = $_POST['file'];
    }
    $user = new  User();
    $user->id = $_POST['userID'];
    $user->email = $_POST['email'];
    $user->userName = $_POST['userName'];
    $user->phone = $_POST['phone'];
    $user->status = $_POST['status'];
    $user->img_path = $fileName;
    echo updateUserByID($user);

}

function updateUserByID($user)
{
    $conn = getDBConnection();
    $myObj = new stdClass();
    try {
        $sql = "UPDATE users 
                SET email = ?, userName = ?, phone = ?, status = ?, imgPath = ?
                WHERE userID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssissi", $user->email, $user->userName, $user->phone, $user->status, $user->img_path, $user->id);
        $stmt->execute();
        mysqli_close($conn);
        $myObj->status = 'success';
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        $myObj->status = 'fail';
    }

    return json_encode($myObj);}

?>
