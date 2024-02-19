<?php 
// Start the session
session_start();
$_SESSION['user_role_id'] = "";
$_SESSION['user_name'] = "";
$_SESSION['email'] = "";
$_SESSION['mobile_number'] = "";
$_SESSION['user_id'] = "";
session_destroy();
header("Location: login.php");
exit;
?>