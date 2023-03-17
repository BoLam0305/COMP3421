<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link href="/CSS/login.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php include_once '../header.php'; ?>
</head>

<body>
    <section class="h-100 h-custom" style="background-color: #FFFFFF;margin-top:3%;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3" style="box-shadow:0px 5px 15px rgb(0 0 0 / 10%);">
                        <img src="../../img/VA1.jpg" class="w-100"
                            style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-2 pb-2 pb-md-0 mb-md-4 px-md-2">Sign up</h3>

                            <form action="../../phpFunctions/signUp.php" method="post" name="SignUpForm">
                            <?php
                                if (isset($_GET['Empty'])) {
                                ?>
                                    <div style="color:red;"><?php
                                            echo $_GET['Empty'];
                                            ?></div><br>
                                <?php
                                }
                                ?>
                            <div class="form-group">
                                    <label for="Name1">Name</label>
                                    <input type="username" id="Name1" class="form-control" name="username"/>

                                    <label class="mt-4" for="Email1">Email address</label>
                                    <input type="email" id="Email1" class="form-control" name="email" />

                                    <label class="mt-4" for="Password1">Password</label>
                                    <input type="password" id="Password1" class="form-control" name="password" />

                                    <label class="mt-4" for="Password2">Password Confirm</label>
                                    <input type="password" id="Password2" class="form-control" name="password2"/>

                                    <label class="mt-4" for="Phone1">Phone</label>
                                    <input type="number" id="Phone1" class="form-control" name="phone"/>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4"
                                    style="background-color:#FF9800;">Submit</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>