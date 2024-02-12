<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $user_password = $row['user_password'];
        $user_role_id = $row['user_role_id'];
        $user_name = $row['user_name'];
        $email = $row['email'];
        $mobile_number = $row['mobile_number'];

        $verify = password_verify($password, $user_password);

        if ($verify) {
            // Start the session
            session_start();
            $_SESSION['user_role_id'] = $user_role_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['email'] = $email;
            $_SESSION['mobile_number'] = $mobile_number;
            // Redirect to another page
            header("Location: index.php");
            exit;
        } else {
            header("Location: login.php");
            exit;
        }
    }
}
?>

<body>
    <div class="container">
        <div class="login-container">
            <div class="avatar">
                <img src="dist/img/Billspaye_logo.png" alt="User Image" style="height: 100px; width: 100px;">
            </div>
            <!-- <h2>Admin Login</h2> -->
            <form method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                        placeholder="Email or Mobile Number" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required>
                </div>
                <button type="submit" name="btn_login" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>