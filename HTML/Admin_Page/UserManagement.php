<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Management</title>

    <!--local CSS-->

    <link href="../../CSS/Admin_Page/right-management.css" rel="stylesheet">
    <link href="../../CSS/Admin_Page/add_modam.css" rel="stylesheet">
    <link href="../../CSS/Admin_Page/left-menu.css" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css"/>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <!--local Js-->
    <script src="../../JS/Admin_Page/UserManagementUI.js"></script>
    <script src="../../JS/Admin_Page/addUserFormValidation.js"></script>
    <script src="../../JS/Admin_Page/updateUserVaildation.js"></script>

    <!--Bosstrap-->
    <script src="https://kit.fontawesome.com/ceae024db6.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
<div id="main-container" class="container">
    <div id="right-content" class="col-12">
        <table class="table caption-top table-hover" id="myTable">
            <div id="table-header">
                <div>User Management</div>
                <div id="add-item-btn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                            class="fas fa-plus-square"></i></div>
            </div>
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">#ID</th>
                <th scope="col"><i class="fas fa-user"></i>Name</th>
                <th scope="col"><i class="fas fa-envelope"></i>Email</th>
                <th scope="col"><i class="fas fa-phone"></i>Phone</th>
                <th scope="col">Status</th>
                <th scope="col">Details</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include_once('../../phpFunctions/getUsers.php');
            $users = json_decode(get_all_users(), false);
            for ($i = 0; $i < count($users); $i++) {
                echo '<tr>';
                echo ' <td class="align-middle">' . $users[$i]->id . '</td>';
                echo ' <td class="align-middle">' . $users[$i]->id . '</td>';
                echo ' <td class="align-middle">' . $users[$i]->userName . '</td>';
                echo ' <td class="align-middle">' . $users[$i]->email . '</td>';
                echo ' <td class="align-middle">' . $users[$i]->phone . '</td>';
                echo ' <td class="align-middle td-status">' . $users[$i]->status . '</td>';
                echo '<td class="align-middle"><button value="' . $users[$i]->id . '" class="btn btn-warning detail-modal-btn" data-bs-toggle="modal" data-bs-target="#detailModal">View</button></td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<!-- Add Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a user <i class="fas fa-user"></i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-form" id="item-form">
                <div class="row">
                    <div>
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' name="image" id="imageUpload" accept=".png, .jpg, .jpeg"/>
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                                <img id="imagePreview" src="../../img/Profile/default_profile.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div>Name</div>
                    <div>
                        <input type="text" id="add_userName">
                    </div>
                    <div id="add-name-msg" class="text-danger"></div>
                </div>
                <div class="row">
                    <div>Password</div>
                    <div>
                        <input type="password" id="add_password">
                    </div>
                    <div id="add-password-msg" class="text-danger"></div>
                </div>
                <div class="row">
                    <div>Email</div>
                    <div>
                        <input type="email" id="add_email">
                    </div>
                    <div id="add-email-msg" class="text-danger"></div>
                </div>
                <div class="row">
                    <div>Phone</div>
                    <div>
                        <input type="number" id="add_phone">
                    </div>
                    <div id="add-number-msg" class="text-danger"></div>
                </div>
                <div class="row">
                    <div>Status</div>
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false" id="add_status">Enable</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item add-status-dropdown" href="#">Enable</a></li>
                            <li><a class="dropdown-item add-status-dropdown" href="#">Disable</a></li>
                        </ul>
                    </div>
                    <div class="row">
                        <div>User Type</div>
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false" id="add_userType">User</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item add-userType-dropdown" href="#">Admin</a></li>
                                <li><a class="dropdown-item add-userType-dropdown" href="#">User</a></li>
                            </ul>
                        </div>
                        <div id="add-type-msg" class="text-danger"></div>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col">
                        <div id="result-msg"></div>
                    </div>
                    <div class="col text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="add-btn">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-user"></i>User Detail #<span id="modal-user_id"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-form" id="detail-form">
                <div class="row text-end modal-form-edit-btn">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div id="detail_img_name" style="display: none"></div>
                <div class="row">
                    <div>
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' name="image" id="imageOnLoad" accept=".png, .jpg, .jpeg"/>
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
                        <input type="text" disabled id="detail-name">
                    </div>
                </div>
                <div class="row">
                    <div>Email</div>
                    <div>
                        <input type="email" disabled id="detail-email">
                    </div>
                    <div id="detail-email-msg" class="text-danger"></div>
                </div>
                <div class="row">
                    <div>Phone</div>
                    <div>
                        <input type="number" disabled id="detail-phone">
                    </div>
                    <div id="detail-phone-msg" class="text-danger"></div>
                </div>
                <div class="row">
                    <div>Status</div>
                    <div class="dropdown">
                        <button disabled id="detail-status" class="btn btn-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown button
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item detail-status-dropdown" href="#">Enable</a></li>
                            <li><a class="dropdown-item detail-status-dropdown" href="#">Disable</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col">
                    <div id="detail-result-msg"></div>
                </div>
                <div class="col text-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="detain-save-btn">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>