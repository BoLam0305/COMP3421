<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../CSS/profile.css">
    <?php include_once '../header.php'; ?>
</head>

<body>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#imageUpload").change(function() {
                readURL(this);
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <?php

    require_once("../../phpFunctions/getDBConnection_bo.php");
    $conn = getDBConnection();
    extract($_SESSION);
    $_STATEMENT = $conn->prepare("SELECT * FROM users WHERE userID = ? and email = ?;");
    $_STATEMENT->bind_param('is', $ID, $email);
    // $SQL = "SELECT * FROM `users` WHERE `userID` = '$ID' and `email` = '$email'";
    // $result = mysqli_query($conn, $SQL);
    $_STATEMENT->execute();
    $result = $_STATEMENT->get_result();
    $result = $result->fetch_array();
    $_STATEMENT->free_result();
    $_STATEMENT->close();
    extract($result);
    echo $userName;
    echo $email;
    // extract($row);
    ?>
    <div class="content">
        <section style="background-color: #eee;">
            <div class="container py-5">

                <div class="row">
                    <div class="col-lg-3">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);">
                                        </div>
                                    </div>
                                </div>
                                <!-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 100%;"> -->
                                <?php
                                // if ($icon == "") {
                                //     echo '<img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 100%;">';
                                // } else {
                                //     echo '<img src="data:image/jpeg;base64,' . base64_encode($profilePic) . '" alt="avatar" class="rounded-circle img-fluid" style="width: 100%;">';
                                // }
                                ?>
                                <h5 class="my-3"><?php echo $userName ?></h5>
                                <!-- <p class="text-muted mb-1">Full Stack Developer</p>
                                <p class="text-muted mb-4">Bay Area, San Francisco, CA</p> -->

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <form action="../../phpFunctions/modifyProfile.php" class="form_control" method="post">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-center">Your Information</h6>
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($_GET['Empty'])) {
                                    ?>
                                        <div class="text-center text-danger"><?php
                                                                                echo $_GET['Empty'];
                                                                                ?></div><br>
                                    <?php
                                    }
                                    ?>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <label class="mb-0">Email</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="text-muted mb-0" type="text" name="email" value="<?php echo $email ?>" disabled>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <label class="mb-0">Full Name</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="text-muted mb-0 nameQWE" type="text" name="userName" value="<?php echo $userName ?>">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <label class="mb-0">Phone</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="text-muted mb-0" type="number" name="phone" value="<?php echo $phone ?>">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" value="Submit" class="button-36" role="button">Modify</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form action="../../phpFunctions/modifyPassword.php" class="form_control" method="post">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-center">Change Password</h6>
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($_GET['EmptyPassword'])) {
                                    ?>
                                        <div class="text-center text-danger"><?php
                                                                                echo $_GET['EmptyPassword'];
                                                                                ?></div><br>
                                    <?php
                                    }
                                    ?>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <label class="mb-0">Old Password</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="text-muted mb-0" type="password" name="oPassword" value="" required>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <label class="mb-0">New Password</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="text-muted mb-0" type="password" name="nPassword" value="">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <label class="mb-0">Confirm Password</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="text-muted mb-0" type="password" name="cPassword" value="">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" value="Submit" class="button-36" role="button">Modify</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <?php
        include_once '../footer.php';
        ?>
    </div>
</body>

</html>