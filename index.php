<?php
session_start();
include 'includes/header.php';

if (isset($_SESSION['user_id'])) {
    header("Location: user/dashboard.php");
} else {
    echo "<h1>Welcome to the To-Do List System</h1>";
    echo "<a href='user/register.php'>Register</a>";
    echo "<a href='user/login.php'>Login</a>";
}

include 'includes/footer.php';
?>
