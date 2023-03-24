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
    <script src="../../JS/checkout.js" defer></script>
    <title>Shopping Cart</title>
    <?php include_once '../header.php'; ?>

</head>

<body>
<div class="cartContainer" id="cartContainer">
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
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#paymentModal">
                        Pay Now
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="paymentModal" tabindex="-1" data-bs-backdrop="static"
     aria-labelledby="paymentModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Select Payment Method</h5>
            </div>
            <div class="modal-body justify-content-center">
                <div id="paymentBtnContainer">
                    <div class="row w-100">
                        <div class="col-6 w-50" id="visaContainer">
                            <div class="custom-radio">
                                <input type="radio" id="visaBtn" name="payment-option" onclick="setMethod('visa')">
                                <label for="visaBtn">
                                    <i class="fa-brands fa-cc-visa visaLogo"></i>
                                    <div class="visaText">Visa</div>
                                </label>
                            </div>
                        </div>
                        <div class="col-6 w-50" id="masterContainer">
                            <div class="custom-radio">
                                <input type="radio" id="masterBtn" name="payment-option" onclick="setMethod('master')">
                                <label for="masterBtn">
                                    <i class="fa-brands fa-cc-mastercard masterLogo"></i>
                                    <div class="masterText">MasterCard</div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-6 w-50">
                        <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Cancel</button>
                    </div>
                    <div class="col-6 w-50">
                        <button type="button" class="btn btn-primary w-100" id="confirmPaymentBtn"
                                onclick="checkOutCart()" disabled>
                            Confirm
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="loadingWrapper d-flex align-items-center justify-content-center" id="loadingWrapper" style="display: block">
    <div class="row">
        <div class="col-lg-6 col-md-8 mx-auto">
            <div class="spinner-border text-primary" style="width: 5rem; height: 5rem; margin-bottom: 1rem;"  role="status"></div>
            <span class="visually-hidden">Loading...</span>
        </div>
        <h1 class="fw-light loadingText d-flex justify-content-center">Loading...</h1>
    </div>
</div>
</body>

</html>