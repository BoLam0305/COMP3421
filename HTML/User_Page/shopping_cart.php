<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style type="text/css">
        .photo {
            height: 200px;
        }
    </style>
    <link rel="stylesheet" href="../../CSS/shopping_cart.css">
    <script src="../../JS/getShoppingCart.js" defer></script>
    <title>Shopping Cart</title>
    <?php include_once '../header.php'; ?>

</head>

<body>
<div class="container" style="margin-top: 5%;">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered text-center">
                <thead style="background-color: #ff9800;">
                <tr>
                    <td scope="col">#</td>
                    <td scope="col">Name</td>
                    <td scope="col">Item Total Price</td>
                    <td scope="col">Quantity</td>
                    <td scope="col">Remove From Cart</td>
                </tr>
                </thead>
                <tbody id="tableRowContainer">
                <tr id="shoppingCartRows" style="display: none">
                    <td class="text-center" scope="row" id="cartItemID"></td>
                    <td id="cartItemName"></td>
                    <td id="cartItemPrice"></td>
                    <td id="cartItemQuantity"></td>
                    <td>
                        <button type="button" class="btn btn-danger" id="cartRemoveItem">Remove</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>


        <div class="row">
            <div class="col-md-12 text-center">
                <div>
                    <h2 id="totalPrice">Total:$103</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <div>
                    <a href="#" class="btn btn-danger">Pay now!</a>
                </div>
            </div>
        </div>

    </div>
</div>
</body>

</html>