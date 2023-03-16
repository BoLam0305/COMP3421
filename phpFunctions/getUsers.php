<?php
include_once ('getDBConnection_bo.php');
include_once ('User.php');
date_default_timezone_set('Asia/Hong_Kong');

function get_all_users()
{
    $json = '';
    $user_lists = array();
    try {
        $conn = getDBConnection();
        $sql = "SELECT * FROM users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $rs = $stmt->get_result();
        $totalCount = $rs->num_rows;

        // gen Json
        if ($totalCount > 0) {
            while ($rc = mysqli_fetch_assoc($rs)) {
                $user = new User();
                extract($rc);
                $user->id = $userID;
                $user->email = $email;
                $user->userName = $userName;
                $user->phone = $phone;
                $user->status = $user->getStatus($status);
                $user->type = $user->getType($userTypeID);
                $user_lists[] = $user;
            }
        } else {
            $user_lists = '';
        }

        //Close DB
        mysqli_free_result($rs);
        mysqli_close($conn);
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
        $json = "false";
    }
    $json = json_encode($user_lists, JSON_PRETTY_PRINT);
    return $json;
}

?>
