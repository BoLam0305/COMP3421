<?php
include_once('getDBConnection_bo.php');
include_once('User.php');
include_once('LocalPath.php');


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
        $fileName = 'default_profile.jpg';
    }

    $user = new User();
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $user->userName = $_POST['userName'];
    $user->phone = $_POST['phone'];
    $user->setType($_POST['userType']);
    $user->status = $_POST['status'];
    $user->img_path = $fileName;

    add_user($user);
    
}



function add_user($user)
{
    $conn = getDBConnection();
    $sql = "INSERT INTO users (email, password, userName, userTypeID, phone, status, imgPath)
        VALUES (?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiiss", $user->email, $user->password, $user->userName,  $user->type, $user->phone, $user->status, $user->img_path);
    $stmt->execute();
    mysqli_close($conn);
}


?>