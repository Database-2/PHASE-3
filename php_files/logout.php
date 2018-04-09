<?php
// Logs out of account
session_start();
$old_user = $_SESSION['username'];
unset($_SESSION['username']);
session_destroy();
// Brings user to login page
header("Location: login.php");
?>