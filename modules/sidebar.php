<?php
// Check if the request is HTTP or HTTPS
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";

// Get the server name
$server_name = $_SERVER['SERVER_NAME'];

// Get the request URI
$request_uri = $_SERVER['REQUEST_URI'];

// Construct the full URL
$current_url = $protocol . $server_name . $request_uri;

// Output the current URL
$url = explode("/", $current_url);

// if ($url[5] == "category.php") {
//     $active = "active";
// } else if ($url[5] == "mostExcitingOffers.php") {
//     $active = "active";
// } else {
//     $active = "";
// } 

?>


<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index.php" class="brand-link">
        <img src="../dist/img/Billspaye_logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: 1; height: 150px;">
        <span class="brand-text font-weight-light">Bills Paye</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <?php // Retrieve data from the session
                $username = $_SESSION['user_name']; ?>
                <a href="#" class="d-block">
                    <?php echo $username; ?>
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"
                id="myDIV">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                <!-- <li class="nav-item <?php echo $url[4] == "index.php" ? "menu-open" : ""; ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../index.php"
                                class="nav-link <?php echo $url[4] == "index.php" ? "active" : ""; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                        
                    </ul>
                </li> -->

                <li class="nav-item">
                    <a href="../index.php" class="nav-link <?php echo $url[4] == "index.php" ? "active" : ""; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="categoryList.php" class="nav-link <?php if ($url[5]) {
                        echo $url[5] == "categoryList.php" ? "active" : "";
                    } ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="topPicks.php" class="nav-link <?php if ($url[5]) {
                        echo $url[5] == "topPicks.php" ? "active" : "";
                    } ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Top Picks
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="offers.php" class="nav-link <?php if ($url[5]) {
                        echo $url[5] == "offers.php" ? "active" : "";
                    } ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Offers
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="wishlist.php" class="nav-link <?php if ($url[5]) {
                        echo $url[5] == "wishlist.php" ? "active" : "";
                    } ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Wishlist
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="mostExcitingOffers.php" class="nav-link <?php if ($url[5]) {
                        echo $url[5] == "mostExcitingOffers.php" ? "active" : "";
                    } ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Exciting Offers
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>