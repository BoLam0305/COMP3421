<?php
include_once('getDBConnection_bo.php');
include_once ('Product.php');
date_default_timezone_set('Asia/Hong_Kong');
getProductsByOrderID(1);
function getProductsByOrderID($orderID)
{
    $product_list = array();

    try {
        $conn = getDBConnection();
        $stmt = $conn->prepare("select * from product left join order_product on product.productID = order_product.productID where orderID = ?");
        $stmt->bind_param("i", $orderID);

        $stmt->execute();
        $rs = $stmt->get_result();
        $totalCount = $rs->num_rows;

        // gen Json
        if ($totalCount > 0) {
            while ($rc = mysqli_fetch_assoc($rs)) {
                $product = new Product();
                extract($rc);
                $product->id =  $productID;
                $product->productName = $productName;
                $product->Price = $Price;
                $product->category = $category;
                $product_list[] = $product;

            }
        } else {
            $order_list = '';
        }

    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
        $json = "false";
    }

    return $product_list;

}

?>
