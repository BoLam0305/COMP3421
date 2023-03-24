<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PolyFood | Order Food Securely</title>

    <link href="../CSS/index.css" rel="stylesheet">
    <script src="../JS/getProducts.js"></script>
    <?php include_once 'header.php'; ?>
</head>

<body>
<main>
    <section class="text-center container highLightContainer">
        <div class="row" id="hlCarouselWrapper" style="display: block">
            <div class="col mx-auto menuHighlight">
                <div id="hlCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-indicators" id="hlCarousel-indicators"></div>
                    <div class="carousel-inner" id="hlCarousel-inner"></div>
                </div>

            </div>
        </div>
    </section>
    <div class="album py-5 bg-light foodOuterWrapper" style="display: none" id="foodOuterWrapper">
        <div class="container">
            <h1 class="text-center fw-light collectionHeader" id="collectionHead">Today's Menu</h1>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 cardWrapper" id="cardWrapper">
                <div class="col foodCard" id="foodCard0">
                    <div class="card shadow-sm">
                        <img id="foodImage" width="420" height="420" alt="foodImage">
                        <div class="card-body">
                            <p class="card-text">
                            <div class="collectionName text-center">
                                <div class="row-9 justify-content-center nameContainer">
                                    <a id="foodName"></a> &bull; HK$ <a id="price"></a>
                                </div>
                                <div class="row-3 justify-content-center statusContainer">
                                    <span class="badge bg-success" id="label-InStock">In Stock</span>
                                    <span class="badge bg-warning text-dark" id="label-LowStock">Almost Sold Out</span>
                                    <span class="badge bg-danger" id="label-SoldOut">Sold Out</span>
                                </div>
                            </div>
                            </p>
                            <div class="viewButton">
                                <?php
                                    if (!isset($_SESSION['email'])) {
                                        echo "<a type='button' class='btn btn-outline-secondary viewBtn w-100' id='LoginBtn' href='/HTML/User_Page/login.php'>
                                                Login to Order
                                              </a>";
                                    }
                                    else {
                                        echo "<a type=\"button\" class=\"btn btn-outline-secondary viewBtn w-100\" id=\"OrderBtn\"
                                                >
                                                Order
                                              </a>";
                                    } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="loadingWrapper d-flex align-items-center justify-content-center" id="loadingWrapper" style="display: block">
        <div class="row">
            <div class="col-lg-6 col-md-8 mx-auto">
                <div class="spinner-border text-primary" style="width: 5rem; height: 5rem; margin-bottom: 1rem;" role="status"></div>
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h1 class="fw-light loadingText d-flex justify-content-center">Loading...</h1>
            </div>
        </div>
    </div>
</main>
 <?php
include_once 'footer.php';
?>

<script>
    getFoods();
</script>

</body>
</html>