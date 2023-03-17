<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PolyFood | Order Food Securely</title>

    <link href="../CSS/index.css" rel="stylesheet">
    <script src="../js/getProducts.js"></script>
    <?php include_once 'header.php'; ?>
</head>

<body>
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Welcome</h1>
                <h1 class="lead text-muted">
                    Browse through our collection of foods and buy them securely.
                </h1>
                <p>
                    <a href="#collectionHead" class="btn btn-primary my-2 disabled" id="allBtn">Loading...</a>
                </p>
            </div>
        </div>
    </section>
    <div class="album py-5 bg-light foodOuterWrapper" style="display: none" id="foodOuterWrapper">
        <div class="container">
            <h1 class="text-center fw-light collectionHeader" id="collectionHead">Today's Menu</h1>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 cardWrapper" id="cardWrapper">
                <div class="col foodCard" id="foodCard0">
                    <div class="card shadow-sm">
                        <img src="../img/TestImage01.jpeg" id="foodImage" width="100%" height="100%" alt="foodImage">
                        <div class="card-body">
                            <p class="card-text">
                            <div class="collectionName text-center">
                                <a id="foodName"></a> &bull; HK$ <a id="price"></a>
                            </div>
                            </p>
                            <div class="viewButton">
                                <a type="button" class="btn btn-outline-secondary viewBtn w-100" id='viewBtn' href="#">
                                    Order
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="loadingWrapper d-flex justify-content-center" id="loadingWrapper" style="display: block">
        <div class="row">
            <div class="col-lg-6 col-md-8 mx-auto">
                <div class="spinner-border text-primary" style="width: 5rem; height: 5rem;" role="status"></div>
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