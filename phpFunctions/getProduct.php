<?php
include_once ('getDBConnection_bo.php');
include_once ('Product.php');
date_default_timezone_set('Asia/Hong_Kong');

function get_all_prodcut()
{
    $json = '';
    $product_lists = array();
    try {
        $conn = getDBConnection();
        $sql = "SELECT * FROM product";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $rs = $stmt->get_result();
        $totalCount = $rs->num_rows;

        // gen Json
        if ($totalCount > 0) {
            while ($rc = mysqli_fetch_assoc($rs)) {
                $product = new Product();
                extract($rc);
                $product->id = $productID;
                $product->productName = $productName;
                $product->Price = $Price;
                $product->Stock = $Stock;
                $product->status = $status;
                $product->isPromoted = $product->getIsPromoted($isPromoted);
                $product->category = $category;
                $product_lists[] = $product;
            }
        } else {
            $product_lists = '';
        }

        //Close DB
        mysqli_free_result($rs);
        mysqli_close($conn);
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
        $json = "false";
    }
    $json = json_encode($product_lists, JSON_PRETTY_PRINT);
    return $json;
}

?>
