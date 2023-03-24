<?php
session_start();
//require 'phpFunctions/checkSessionExpire.php';
//require 'phpFunctions/queryUserBalance.php';

// ask if the user wants to login again after session expire
//if(checkSessionExpire()){
//    echo ("<SCRIPT LANGUAGE='JavaScript'>
//           if(confirm('Session expired, please login again.')){
//               window.location.href='login2.php';
//           }
//           </SCRIPT>");
//}
//?>
<!--CSS Files-->
<link href="../CSS/header.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

<!--JS Files-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/ceae024db6.js" crossorigin="anonymous"></script>


<meta name="google-signin-client_id"
      content="896534143716-5d67cdf7rmrj09m70otueq582efiej25.apps.googleusercontent.com">
<script src="https://apis.google.com/js/platform.js" async defer></script>


<header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark shadow-sm header">
        <div class="container">
            <a href="/HTML/home.php" class="navbar-brand d-flex align-items-center">
                <i class="fa-solid fa-cubes headerCubes"></i>
                <strong>PolyFood</strong>
            </a>

            <?php
            extract($_SESSION);

            //            if(isset($email)){
            //                $balance = getUserBalance($email);
            //            }

            // Show the login and register button if the user is not logged in
            if (!isset($email)) {
                echo '<div class="navbarButtonSet justify-content-end">
                        <a type="button" class="btn btn-secondary loginBtn" href="/HTML/User_Page/login.php">Login</a>
                        <a type="button" class="btn btn-secondary registerBtn" href="/HTML/User_Page/sign_up.php">Register</a>
                      </div> ';
            } else {
                if ($Identity == 'admin') {
                    echo "
<<<<<<< HEAD
                <div class='admin-bar-function'><a href='./ProductManagement.php'> Menu Management</a></div>
                <div class='admin-bar-function'><a href='./OrderManagement.php'>Order Management</a> </div>
                <div class='admin-bar-function'><a href='./UserManagement.php'>User Management</a> </div>
=======
                <div class='admin-bar-function'><a href='/HTML/Admin_Page/ProductManagement.php'> Menu Management</a></div>
                <div class='admin-bar-function'><a href='/HTML/Admin_Page/OrderManagement.php'>Order Management</a> </div>
                <div class='admin-bar-function'><a href='/HTML/Admin_Page/UserManagement.php'>User Management</a> </div>
                <div class='admin-bar-function'><a href='/HTML/Admin_Page/showOrder.php'>Order</a> </div>
                
>>>>>>> origin/main
                <div class=\"collapse navbar-collapse justify-content-end\" id=\"navbarNavDarkDropdown\">
                        <ul class=\"navbar-nav\">
                            <li class=\"nav-item dropdown\">
                                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDarkDropdownMenuLink\"
                                role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                    <i class=\"fa-regular fa-circle-user userIco\"></i>
                                    $email
                                </a>
                                <ul class=\"dropdown-menu dropdown-menu-dark\" aria-labelledby=\"navbarDarkDropdownMenuLink\">
                                  <li>
                                    <a class=\"dropdown-item\" href=\"/HTML/User_Page/userProfile.php\">My Profile</a>
                                  </li>
                                  <li>
                                    <a class=\"dropdown-item\" href=\"../HTML/User_Page/shopping_cart.php\">Cart</a>
                                  </li>
                                  <li><hr class=\"dropdown-divider\"></li>
                                  <li><a class=\"dropdown-item\" href=\"/phpFunctions/logout.php\">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                     </div>";
                } else { // signed in
                    echo "<div class=\"collapse navbar-collapse justify-content-end\" id=\"navbarNavDarkDropdown\">
                        <ul class=\"navbar-nav\">
                            <li class=\"nav-item dropdown\">
                                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDarkDropdownMenuLink\"
                                role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                    <i class=\"fa-regular fa-circle-user userIco\"></i>
                                    $email
                                </a>
                                <ul class=\"dropdown-menu dropdown-menu-dark\" aria-labelledby=\"navbarDarkDropdownMenuLink\">
                                  <li>
                                    <a class=\"dropdown-item\" href=\"/HTML/User_Page/userProfile.php\">My Profile</a>
                                  </li>
                                  <li>
                                    <a class=\"dropdown-item\" href=\"../HTML/User_Page/shopping_cart.php\">Cart</a>
                                  </li>
                                  <li><hr class=\"dropdown-divider\"></li>
                                  <li><a class=\"dropdown-item\" href=\"/phpFunctions/logout.php\">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                     </div>";
                }
            }


            ?>
        </div>
    </nav>
</header>