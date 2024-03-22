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
// echo "Current URL: " . $current_url;
$url = explode("/", $current_url);

// Retrieve data from the session
$username = $_SESSION['user_name'];
$user_role_id = $_SESSION['user_role_id'];
$user_role = $_SESSION['user_role'];

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="dist/img/Billspaye_logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; height: 150px;">
    <span class="brand-text font-weight-light">Bills Paye</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">
          <?php echo $user_role . '</br>' . $username; ?>
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
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="index.php" class="nav-link <?php if ($url[4]) {
                                                echo $url[4] == "index.php" ? "active" : "";
                                              } ?>">
            <i class="fas fa-tachometer-alt nav-icon"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <?php if ($user_role_id == 1) { ?>
          <li class="nav-item">
            <a href="modules/users.php" class="nav-link <?php if ($url[5]) {
                                                          echo $url[5] == "users.php" || $url[5] == "users.php" ? "active" : "";
                                                        } ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="modules/categoryList.php" class="nav-link <?php if ($url[5]) {
                                                                  echo $url[5] == "categoryList.php" || $url[5] == "category.php" ? "active" : "";
                                                                } ?>">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="modules/categoryItems.php" class="nav-link <?php if ($url[5]) {
                                                                  echo $url[5] == "categoryItems.php" || $url[5] == "addCategoryItem.php" ? "active" : "";
                                                                } ?>">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Subcategories
              </p>
            </a>
          </li>
        <?php } ?>
        <li class="nav-item">
          <a href="modules/mostExcitingOffers.php" class="nav-link <?php if ($url[5]) {
                                                                      echo $url[5] == "mostExcitingOffers.php" || $url[5] == "addExcitingOffers.php" ? "active" : "";
                                                                    } ?>">
            <i class="nav-icon fas fa-gift"></i>
            <p>
              Offers
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="modules/menus.php" class="nav-link <?php if ($url[5]) {
                                                        echo $url[5] == "menus.php" ? "active" : "";
                                                      } ?>">
            <i class="nav-icon fas fa-bars menu-icon"></i>
            <p>
              Menu
            </p>
          </a>
        </li>
        <?php if ($user_role_id == 1) { ?>
          <li class="nav-item">
            <a href="modules/clients.php" class="nav-link <?php if ($url[5]) {
                                                            echo $url[5] == "clients.php" || $url[5] == "addClient.php" ? "active" : "";
                                                          } ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Clients
              </p>
            </a>
          </li>

        <?php } ?>

        <li class="nav-item">
          <a href="modules/photos.php" class="nav-link <?php if ($url[5]) {
                                                          echo $url[5] == "photos.php" ? "active" : "";
                                                        }
                                                        ?>">
            <i class="nav-icon fas fa-images"></i>
            <p>
              Photos
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="modules/wishlist.php" class="nav-link <?php if ($url[5]) {
                                                            echo $url[5] == "wishlist.php" ? "active" : "";
                                                          }
                                                          ?>">
            <i class="nav-icon fas fa-heart"></i>
            <p>
              Wishlist
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="modules/reviews.php" class="nav-link <?php if ($url[5]) {
                                                          echo $url[5] == "reviews.php" ? "active" : "";
                                                        }
                                                        ?>">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Reviews
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="modules/posts.php" class="nav-link <?php if ($url[5]) {
                                                        echo $url[5] == "posts.php" ? "active" : "";
                                                      }
                                                      ?>">
            <i class="nav-icon fas fa-blog"></i>
            <p>
              Posts
            </p>
          </a>
        </li>

        <li class="nav-item <?php if ($url[5]) {
                              echo ($url[5] == "transaction_history.php") || ($url[5] == "payout.php") || ($url[5] == "payout_history.php")  ? "menu-open" : "";
                            }
                            ?>">
          <a href="#" class="nav-link <?php if ($url[5]) {
                                        echo ($url[5] == "transaction_history.php") || ($url[5] == "payout.php") || ($url[5] == "payout_history.php") ? "active" : "";
                                      }
                                      ?>">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>
              Payments
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="modules/transaction_history.php" class="nav-link <?php if ($url[5]) {
                                                                  echo $url[5] == "transaction_history.php" ? "active" : "";
                                                                }
                                                                ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Transaction History</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="modules/payout.php" class="nav-link <?php if ($url[5]) {
                                                      echo $url[5] == "payout.php" ? "active" : "";
                                                    }
                                                    ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Payout</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="modules/payout_history.php" class="nav-link <?php if ($url[5]) {
                                                              echo $url[5] == "payout_history.php" ? "active" : "";
                                                            }
                                                            ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Payout History</p>
              </a>
            </li>
          </ul>
        </li>


      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
