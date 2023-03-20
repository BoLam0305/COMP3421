<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link href="../../CSS/login.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php include_once '../header.php'; ?>
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="row justify-content-center">
                    <div class="col-10 d-flex" style="margin:30px; box-shadow:0px 5px 15px rgb(0 0 0 / 10%); border-radius:15px;">
                        <div id="body-right" class="col-5" style="margin:60px 50px 70px;">
                            <img src="../../img/VA2.jfif" class="img-fluid" alt="Sample image">
                        </div>
                        <div id="body-right" class="col-5" style="margin:30px;">
                            <form action="../../phpFunctions/login.php" method="post" name="LoginForm">
                                <div class="divider d-flex align-items-center my-4">
                                    <h3 class="text-center fw-bold mx-3 mb-0">Sign in</h3>
                                </div>
                                <?php
                                if (isset($_GET['Empty'])) {
                                ?>
                                    <div style="color:red;"><?php
                                            echo $_GET['Empty'];
                                            ?></div><br>
                                <?php
                                }
                                ?>
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3">Email address</label>
                                    <input type="email" id="form3Example3" class="form-control form-control-lg" placeholder="Enter a valid email address" name="email" />
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="form3Example4">Password</label>
                                    <input type="password" id="form3Example4" class="form-control form-control-lg" placeholder="Enter password" name="password" />
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Checkbox -->
                                    <div class="form-check mb-0">
                                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                        <label class="form-check-label" for="form2Example3">
                                            Remember me
                                        </label>
                                    </div>
                                    <a href="#!" class="text-body">Forgot password?</a>
                                </div>

                                <div class="text-center text-lg-start mt-4 pt-2">
                                    <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login
                                    </button>
                                    <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!" class="link-danger">Register</a>
                                    </p>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</body>

</html>