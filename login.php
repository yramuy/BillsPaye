<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BillsPaye</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 62px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .avatar {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            border-radius: 50%;
            overflow: hidden;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #logo {
            height: 10em;
            width: 11em;
            position: relative;
            left: 6em;
        }
    </style>
</head>
<!-- Admin Login -->
<?php
require_once('modules/database.php');
if (isset($_POST['btn_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM tbl_user WHERE (email = '$username' OR mobile_number = '$username')";
    $result = mysqli_query($conn, $query);

    $message = "Username or Password incorrect";

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $user_password = $row['user_password'];
        $user_role_id = $row['user_role_id'];
        $user_name = $row['user_name'];
        $email = $row['email'];
        $mobile_number = $row['mobile_number'];
        $user_id = $row['id'];

        if ($user_role_id == 1) {
            $role_name = 'Admin';
        } else if ($user_role_id == 2) {
            $role_name = 'User';
        } else {
            $role_name = 'Client';
        }

        $verify = password_verify($password, $user_password);

        if ($verify) {
            // Start the session
            session_start();
            $_SESSION['user_role_id'] = $user_role_id;
            $_SESSION['user_role'] = $role_name;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['email'] = $email;
            $_SESSION['mobile_number'] = $mobile_number;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['is_login'] = true;
            // Redirect to another page
            header("Location: index.php");
            exit;
        } else {

            header("Location: login.php?message=$message");
            exit;
        }
    } else {

        header("Location: login.php?message=$message");
        exit;
    }
}

?>

<style>
    body {
        background-color: lightgray;
        /* Specify the path to your image */
        /* background-image: url('uploads/login_bg.jpg'); */
        /* Set background size to cover the entire body */
        /* background-size: cover; */
        /* Set background repeat to no-repeat to prevent image from repeating */
        /* background-repeat: no-repeat; */
        /* height: 100px; */
    }
</style>

<body>
    <div class="container">
        <div class="login-container">
            <div class="avatar1">
                <img src="dist/img/Billspaye_logo.png" id="logo" alt="User Image">
            </div>
            <!-- <h2>Admin Login</h2> -->
            <form method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Email or Mobile Number" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="btn_login" class="btn btn-primary btn-block">Login</button>
                <!-- Warning Alert -->
                <br />
                <!-- Example alert with auto close -->
                <?php if (isset($_GET['message'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="autoCloseAlert">
                        <?php echo $_GET['message']; ?>
                    </div>
                <?php } ?>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<script>
    // Automatically close the alert after 5 seconds
    window.setTimeout(function() {
        document.getElementById('autoCloseAlert').remove();
    }, 3000);
</script>