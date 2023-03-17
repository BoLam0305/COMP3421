<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@700&family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Css/mina.css" type="text/css">
    <script src="/javaScript/w3.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <style type="text/css">
        .photo {
            height: 200px;
        }
    </style>
    <?php include_once '../header.php'; ?>
    <link rel="stylesheet" href="../../CSS/shopping_cart.css">
    <title>Shoping Cart</title>

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
                            <td scope="col">Price</td>
                            <td scope="col">Quantity</td>
                            <td scope="col">Remove the goods</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" scope="row">1</td>
                            <td>One Gor Pork Rice</td>
                            <td>$53</td>
                            <td>1</td>
                            <td><button type="button" class="btn btn-danger">Remove</button></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td class="text-center" scope="row">2</td>
                            <td>Food2</td>
                            <td>$50</td>
                            <td>1</td>
                            <td><button type="button" class="btn btn-danger">Remove</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="row">
                <div class="col-md-12 text-center">
                    <div>
                        <h2>Total:$103</h2>
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