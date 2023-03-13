<?php
error_reporting(-1);

session_start();

include 'getDBConnection.php';
date_default_timezone_set('Asia/Hong_Kong');
getAllProducts();

//$nftID = $_POST['nftID'] ?? NULL;
//$usrEmail = $_SESSION['email'] ?? NULL;
//$userID = getUserIDByEmail($usrEmail);
//$fullURL = $_SERVER['HTTP_REFERER'];
//$pageFName = basename(strtok($fullURL, '?'));
//$homePageFName = "NFTshowcase.php";
//$nftDetailsFName = "nftDetails.php";
//$profileFName = "MyNFT.php";
//$functionName = $_POST['functionName'] ?? NULL;
//
//if ($pageFName == $homePageFName || $pageFName == $nftDetailsFName || $pageFName == $profileFName) {
//    getNFTsByID($nftID, $userID, $pageFName);
//}

function getAllProducts()
{
    $count = 0;
    $products[$count] = array();
    $conn = getDBConnection();

    try{
        $sql = "SELECT * FROM product";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $rs = $stmt->get_result();

        $totalCount = $rs->num_rows;

        if ($totalCount > 0) {
            while ($rc = mysqli_fetch_assoc($rs)) {
                $products[$count]['productID'] = $rc['productID'];
                $products[$count]['productName'] = $rc['productName'];
                $products[$count]['Price'] = $rc['Price'];
                $products[$count]['isPromoted'] = $rc['isPromoted'];
                $products[$count]['category'] = $rc['category'];
                $count++;
            }
        } else {
            $products = '';
        }

        mysqli_free_result($rs);
        mysqli_close($conn);

        header('Content-Type: application/json;');

        $json = json_encode($products, JSON_PRETTY_PRINT);

        if ($json) {
            echo $json;
        } else {
            echo json_last_error_msg();
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}





//function getNFTsByID($nftID, $userID, $pageFName)
//{
//    $currentUser = 'NOT LOGGED IN';
//    $count = 0;
//    $homePageFName = "NFTshowcase.php";
//    $nftDetailsFName = "nftDetails.php";
//    $profileFName = "MyNFT.php";
//    $nfts [$count] = array();
//    $dbConnect = new dbConnect();
//    $conn = $dbConnect->getDBConnect();
//
//    try {
//        if ($pageFName == $homePageFName) {
//            $stmt = $conn->prepare("SELECT * FROM nft");
//        } else if (($pageFName == $nftDetailsFName) && isset($nftID)) {
//            $stmt = $conn->prepare("SELECT * FROM nft WHERE nftKey = ?");
//            $stmt->bind_Param('s', $nftID);
//        } else if (($pageFName == $profileFName) && isset($userID)) {
//            $stmt = $conn->prepare("SELECT * FROM nft WHERE ownerID = ?");
//            $stmt->bind_Param('s', $userID);
//        }
//
//        if ($userID != NULL) {
//            $currentUser = getUserByID($userID);
//        }
//
//        $stmt->execute();
//
//        $rs = $stmt->get_result();
//
//        $totalCount = $rs->num_rows;
//
//        if ($totalCount > 0) {
//            while ($rc = mysqli_fetch_assoc($rs)) {
//                $dt = new DateTime($rc['postedDate']);
//                $dt->setTimezone(new DateTimeZone("Asia/Hong_Kong"));
//                $formattedTime = date_format($dt, 'l, jS F Y \a\t g:i:sa');
//
//                $elapsedPostTime = getElapsedTime($rc['postedDate']);
//
//                $nfts [$count] ['nftID'] = $rc['nftKey'];
//                $nfts [$count] ['nftName'] = $rc['nftName'];
//                $nfts [$count] ['nftDescription'] = $rc['nftDescription'];
//                $nfts [$count] ['currentUser'] = $currentUser;
//                $nfts [$count] ['nftPrice'] = $rc['price'];
//                $nfts [$count] ['nftOwner'] = getUserByID($rc['ownerID']);
//                $nfts [$count] ['nftAuthor'] = getUserByID($rc['nftAuthor']);
//                $nfts [$count] ['nftPostDate'] = $formattedTime;
//                $nfts [$count] ['nftPostedElapsedDate'] = $elapsedPostTime;
//                $nfts [$count] ['nftCollection'] = $rc['nftCollection'];
//                $count++;
//            }
//        } else {
//            $nfts = '';
//        }
//
//        mysqli_free_result($rs);
//        mysqli_close($conn);
//
//        header('Content-Type: application/json;');
//
//        $json = json_encode($nfts, JSON_PRETTY_PRINT);
//
//        if ($json) {
//            echo $json;
//        } else {
//            echo json_last_error_msg();
//        }
//    } catch (Exception $e) {
//        echo 'Caught exception: ', $e->getMessage(), "\n";
//    }
//}
//
//function getUserByID($userID)
//{
//    $dbConnect = new dbConnect();
//    $conn = $dbConnect->getDBConnect();
//
//    $stmt = $conn->prepare("SELECT userName FROM users WHERE userID = ?");
//    $stmt->bind_param("s", $userID);
//    $stmt->execute();
//
//    $rs = $stmt->get_result();
//
//    $rc = mysqli_fetch_assoc($rs);
//    extract($rc);
//
//    $stmt->close();
//
//    mysqli_free_result($rs);
//    mysqli_close($conn);
//
//    return $userName;
//}
//
//function getUserIDByEmail($userEmail)
//{
//    if ($userEmail == NULL) {
//        return '';
//    }
//
//    $dbConnect = new dbConnect();
//    $conn = $dbConnect->getDBConnect();
//
//    $stmt = $conn->prepare("SELECT userID FROM users WHERE email = ?");
//    $stmt->bind_param("s", $userEmail);
//    $stmt->execute();
//
//    $rs = $stmt->get_result();
//
//    $rc = mysqli_fetch_assoc($rs);
//
//    extract($rc);
//
//    $stmt->close();
//
//    mysqli_free_result($rs);
//    mysqli_close($conn);
//
//    return $userID;
//}
//
//function getElapsedTime($datetime, $full = false)
//{
//    $now = new DateTime();
//    $now->setTimezone(new DateTimeZone("Asia/Hong_Kong"));
//    $ago = new DateTime($datetime, new DateTimeZone('Asia/Hong_Kong'));
//    $diff = $now->diff($ago);
//
//    $diff->w = floor($diff->d / 7);
//    $diff->d -= $diff->w * 7;
//
//    $string = array(
//        'y' => 'year',
//        'm' => 'month',
//        'w' => 'week',
//        'd' => 'day',
//        'h' => 'hour',
//        'i' => 'minute',
//        's' => 'second',
//    );
//
//    foreach ($string as $k => &$v) {
//        if ($diff->$k) {
//            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
//        } else {
//            unset($string[$k]);
//        }
//    }
//
//    if (!$full) $string = array_slice($string, 0, 1);
//    return $string ? implode(', ', $string) . ' ago' : 'just now';
//}
//
