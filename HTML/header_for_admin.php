<?php session_start(); ?>

<header>
    <link href="../../CSS/Admin_Page/left-menu.css" rel="stylesheet">

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark shadow-sm header">
        <div class="container">
            <a href="/HTML/home.php" class="navbar-brand d-flex align-items-center">
                <i class="fa-solid fa-cubes headerCubes"></i>
                <strong>PolyFood</strong>
            </a>

            <?php
            extract($_SESSION);
            // Show the login and register button if the user is not logged in
            if (!isset($email)) {
                header('Location: ../User_Page/login.php');
            } else { // signed in
                echo "
                        <div class='collapse navbar-collapse' id='navbarNav'>
                            <ul class='navbar-nav'>
                                <li class='nav-item active'>
                                    <a class='nav-link' href='/HTML/Admin_Page/UserManagement.php'>User Management</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='/HTML/Admin_Page/OrderManagement.php'>Order Management</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='/HTML/Admin_Page/ProductManagement.php'>Product Management</a>
                                </li>                                
                                <li class='nav-item'>
                                    <a class='nav-link' href='/HTML/Admin_Page/showOrder.php'>All Orders</a>
                                </li>
                            </ul>
                        </div>

                        <ul class=\"navbar-nav\">
                            <li class=\"nav-item dropdown\">
                                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDarkDropdownMenuLink\"
                                role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                    <i class=\"fa-regular fa-circle-user userIco\"></i>
                                    $email
                                </a>
                                <ul class=\"dropdown-menu dropdown-menu-dark\" aria-labelledby=\"navbarDarkDropdownMenuLink\">
                                  <li><a class=\"dropdown-item\" href=\"/phpFunctions/logout.php\">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                     </div>";
            } ?>
        </div>
    </nav>
</header>