<?php
include_once('getDBConnection_bo.php');
include_once('User.php');
date_default_timezone_set('Asia/Hong_Kong');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo getUserByID($_POST['userID']);
}


function getUserByID($userID)
{
    $user = new User();
    $conn = getDBConnection();
    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE userID = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $rs = $stmt->get_result();
        $rc = mysqli_fetch_assoc($rs);
        extract($rc);
        $stmt->close();
        mysqli_free_result($rs);
        mysqli_close($conn);

        $user->id = $userID;
        $user->email = $email;
        $user->userName = $userName;
        $user->phone = $phone;
        $user->status = $status;
        $user->status = $user->getStatus($status);
        $user->img_path = $imgPath;

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    return json_encode($user, JSON_UNESCAPED_SLASHES);

}


?>
