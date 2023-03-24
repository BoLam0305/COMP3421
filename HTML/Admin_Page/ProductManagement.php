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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <!--local Js-->
    <script src="../../JS/Admin_Page/ProductManagementUI.js"></script>
    <script src="../../JS/Admin_Page/addProductValidation.js"></script>
    <script src="../../JS/Admin_Page/updateProductVaildation.js"></script>

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
    <?php include_once '../header.php'; ?>
    <?php
    extract($_SESSION);
    if (isset($email)) {
        if ($Identity != 'admin') {
            header('Location: /HTML/User_Page/login.php');
        }
    }else{
        header('Location: /HTML/User_Page/login.php');
    }

    ?>

</head>

<body>
    <div id="main-container" class="row" style="padding-top:3%;">
        <div id="right-content" class="col-12">
            <div class="container">
                <table class="table caption-top table-hover" id="myTable">
                    <div id="table-header">
                        <div>Items Management</div>
                        <div id="add-item-btn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus-square"></i></div>
                    </div>
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
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
                            echo ' <td class="align-middle">' . $productes[$i]->id . '</td>';
                            echo ' <td class="align-middle">' . $productes[$i]->productName . '</td>';
                            echo ' <td class="align-middle">' . $productes[$i]->category . '</td>';
                            echo ' <td class="align-middle">' . $productes[$i]->Price . '</td>';
                            echo ' <td class="align-middle">' . $productes[$i]->isPromoted . '</td>';
                            echo ' <td class="align-middle td-stock">' . $productes[$i]->Stock . '</td>';
                            echo ' <td class="align-middle td-status">' . $productes[$i]->status . '</td>';
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
                    <h5 class="modal-title" id="exampleModalLabel">Add a Product <i class="fas fa-hamburger"></i></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-form" id="item-form">
                    <div class="row">
                        <div>
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' name="image" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    <img id="imagePreview" src="../../img/Product/default_product.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div>Name</div>
                        <div>
                            <input type="text" id="productName">
                        </div>
                        <div id="add-productName-msg"></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div>Category</div>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="selected-category">
                                    Food
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item category-dropdown-item" href="#">Food</a></li>
                                    <li><a class="dropdown-item category-dropdown-item" href="#">Drink</a></li>
                                    <li><a class="dropdown-item category-dropdown-item" href="#">Main</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col">
                            <div>Status</div>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="selected-status">
                                    Enable
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item status-dropdown-item" href="#">Disable</a></li>
                                    <li><a class="dropdown-item status-dropdown-item" href="#">Enable</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col">
                            <div>Promotion</div>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="selected-promotion">
                                    Not Promoted
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item promotion-dropdown-item" href="#">Promote</a></li>
                                    <li><a class="dropdown-item promotion-dropdown-item" href="#">Not Promoted</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div>Price</div>
                            <div>
                                <input type="number" id="productPrice">
                            </div>
                            <div id="add-price-msg"></div>
                        </div>
                        <div class="col">
                            <div>Stock</div>
                            <div>
                                <input type="number" id="stock">
                            </div>
                            <div id="add-stock-msg"></div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="add-btn">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-hamburger"></i>Product #<span id="modal-product_id"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-form" id="detail-item-form">
                    <div class="row text-end modal-form-edit-btn">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                    <div class="row">
                        <div>
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' name="image" id="imageOnLoad" accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    <img id="detail_imagePreview" src="" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div>Name</div>
                        <div>
                            <input type="text" id="detail-productName">
                        </div>
                        <div id="detail-productName-msg" class="text-danger"></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div>Category</div>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="detail-selected-category">
                                    Select a type
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item category-dropdown-item" href="#">Food</a></li>
                                    <li><a class="dropdown-item category-dropdown-item" href="#">Drink</a></li>
                                    <li><a class="dropdown-item category-dropdown-item" href="#">Main</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col">
                            <div>Status</div>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="detail-selected-status">
                                    Select a type
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item status-dropdown-item" href="#">Disable</a></li>
                                    <li><a class="dropdown-item status-dropdown-item" href="#">Enable</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col">
                            <div>Promotion</div>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="detail-selected-promotion">
                                    Select a type
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item promotion-dropdown-item" href="#">Promote</a></li>
                                    <li><a class="dropdown-item promotion-dropdown-item" href="#">Not Promoted</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div>Price</div>
                            <div>
                                <input type="number" id="detail-productPrice">
                            </div>
                            <div id="detail-price-msg" class="text-danger"></div>
                        </div>
                        <div class="col">
                            <div>Stock</div>
                            <div>
                                <input type="number" id="detail-stock">
                            </div>
                            <div id="detail-stock-msg" class="text-danger"></div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="detain-save-btn">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Detail Modal -->
    <!-- <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <input type="text" id="productName">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div>Category</div>
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false" id="selected-category">
                            Select a type
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item category-dropdown-item" href="#">Food</a></li>
                            <li><a class="dropdown-item category-dropdown-item" href="#">Drink</a></li>
                            <li><a class="dropdown-item category-dropdown-item" href="#">Main</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div>Status</div>
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false" id="selected-status">
                            Select a type
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item status-dropdown-item" href="#">Disable</a></li>
                            <li><a class="dropdown-item status-dropdown-item" href="#">Enable</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div>Promotion</div>
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false" id="selected-promotion">
                            Select a type
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item promotion-dropdown-item" href="#">Promote</a></li>
                            <li><a class="dropdown-item promotion-dropdown-item" href="#">Not Promoted</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div>Price</div>
                    <div>
                        <input type="number" id="productPrice">
                    </div>
                </div>
                <div class="col">
                    <div>Stock</div>
                    <div>
                        <input type="number" id="stock">
                    </div>
                </div>

            </div>
            <div class="row">
                <div>Image</div>
                <div class="image-upload">
                    <input type="file" name="" id="logo" onchange="fileValue(this)">
                    <label for="logo" class="upload-field" id="file-label">
                        <div class="file-thumbnail">
                            <img id="image-preview" src="https://www.btklsby.go.id/images/placeholder/basic.png"
                                 alt="">
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
            <button type="button" class="btn btn-primary" id="add-btn">Save changes</button>
        </div>
    </div>
</div>
</div> -->

</body>
<style>


</style>

</html>