<?php
include '../../phpFunctions/getDBConnection_bo.php';
date_default_timezone_set('Asia/Hong_Kong');


function insert_user($email, $password, $userName, $icon, $userTypeID, $phone)
{
    $conn = getDBConnection();
    $sql = "INSERT INTO users (email, password, userName, icon, userTypeID, phone)
        VALUES (?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $email, $password, $userName, $icon, $userTypeID, $phone);
    $stmt->execute();

    mysqli_close($conn);

}

function update_user($id,$email, $password, $userName, $icon, $userTypeID, $phone){

}


function get_all_users()
{
    $userJson = array();

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
                $userID = $rc['userID'];
                $userJson[$userID] = array();
                $userJson[$userID]['userID'] = $rc['userID'];
                $userJson[$userID]['userName'] = $rc['userName'];
                $userJson[$userID]['email'] = $rc['email'];
                $userJson[$userID]['icon'] = $rc['icon'];
                $userJson[$userID]['userTypeID'] = $rc['userTypeID'];
                $userJson[$userID]['phone'] = $rc['phone'];
            }
        } else {
            $userJson = '';
        }

        $json = json_encode($userJson, JSON_PRETTY_PRINT);
        echo $json;

        //Close DB
        mysqli_free_result($rs);
        mysqli_close($conn);
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
}
?>