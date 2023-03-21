<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product Management</title>

    <!--local CSS-->
    <link href="../../CSS/Admin_Page/left-menu.css" rel="stylesheet">
    <link href="../../CSS/Admin_Page/right-management.css" rel="stylesheet">
    <link href="../../CSS/Admin_Page/add_modam.css" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!--local Js-->
    <script src="../../JS/Admin_Page/ProductManagementUI.js"></script>

    <!--Bosstrap-->
    <script src="https://kit.fontawesome.com/ceae024db6.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body>
    <div>Menu-bar</div>
    <div id="main-container" class="row">
        <div class="col-2 h-100" id="left-menu">
            <div class="row-3 left-menu-target">Menu Management</div>
            <div class="row-3">Order Management</div>
            <div class="row-3">User Management</div>
        </div>
        <div id="right-content" class="col-10">
            <div class="container">
                <table class="table caption-top table-hover">
                    <div id="table-header">
                        <div>Items Management</div>
                        <div id="add-item-btn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus-square"></i></div>
                    </div>

                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col"><i class="fas fa-hamburger"></i>Name</th>
                            <th scope="col"><i class="fas fa-utensils"></i>Category</th>
                            <th scope="col">$ Price</th>
                            <th scope="col">Promotion</th>
                            <th scope="col"><i class="fas fa-warehouse"></i>Stock</th>
                            <th scope="col">Status</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once('../../phpFunctions/getProduct.php');
                        $productes = json_decode(get_all_prodcut(), false);
                        for ($i = 0; $i < count($productes); $i++) {
                            echo '<tr>';
                            echo ' <td class="align-middle">' . $productes[$i]->id . '</td>';
                            echo ' <td class="align-middle">' . $productes[$i]->productName . '</td>';
                            echo ' <td class="align-middle">' . $productes[$i]->category . '</td>';
                            echo ' <td class="align-middle">' . $productes[$i]->Price . '</td>';
                            echo ' <td class="align-middle">' . $productes[$i]->isPromoted . '</td>';
                            echo ' <td class="align-middle">' . $productes[$i]->Stock . '</td>';
                            echo ' <td class="align-middle">' . $productes[$i]->status . '</td>';
                            echo '<td class="align-middle"><button value="' . $productes[$i]->id . '" class="btn btn-warning detail-modal-btn" data-bs-toggle="modal" data-bs-target="#detailModal">View</button></td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a user <i class="fas fa-hamburger"></i></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-form" id="item-form">
                    <div class="row">
                        <div>Name</div>
                        <div>
                            <input type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div>Category</div>
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Select a type
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Food</a></li>
                                <li><a class="dropdown-item" href="#">Drink</a></li>
                                <li><a class="dropdown-item" href="#">Main</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div>Price</div>
                        <div>
                            <input type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div>Image</div>
                        <div class="image-upload">
                            <input type="file" name="" id="logo" onchange="fileValue(this)">
                            <label for="logo" class="upload-field" id="file-label">
                                <div class="file-thumbnail">
                                    <img id="image-preview" src="https://www.btklsby.go.id/images/placeholder/basic.png" alt="">
                                    <h3 id="filename">
                                        Drag and Drop
                                    </h3>
                                    <p>Supports JPG, PNG, SVG</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-hamburger"></i>Product Detail#<span id="modal-product_id"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-form" id="detail-form">
                    <div class="row text-end modal-form-edit-btn">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                    <div class="row">
                        <div class="modal-form-img-div">
                            <img src="../../img/TestImage01.jpeg" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div>Product Name</div>
                        <div>
                            <input type="text" disabled id="detail-productName">
                        </div>
                    </div>
                    <div class="row">
                        <div>Price</div>
                        <div>
                            <input type="number" disabled id="detail-price">
                        </div>
                    </div>
                    <div class="row">
                        <div>Stock</div>
                        <div>
                            <input type="text" disabled id="detail-stock">
                        </div>
                    </div>
                    <div class="row">
                        <div>Is Promoted</div>
                        <div class="dropdown">
                            <button disabled id="detail-promote" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown button
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item detail-promote-dropdown" href="#">Promoting</a></li>
                                <li><a class="dropdown-item detail-promote-dropdown" href="#">Not Promoting</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div>Status</div>
                        <div class="dropdown">
                            <button disabled id="detail-status" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown button
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item detail-status-dropdown" href="#">Enable</a></li>
                                <li><a class="dropdown-item detail-status-dropdown" href="#">Disable</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div>Category</div>
                        <div class="dropdown">
                            <button disabled id="detail-category" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown button
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item detail-category-dropdown" href="#">Main</a></li>
                                <li><a class="dropdown-item detail-category-dropdown" href="#">Category 2</a></li>
                                <li><a class="dropdown-item detail-category-dropdown" href="#">Category 3</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</body>
<style>


</style>

</html>