<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'seller') {
    header("Location: login.php");
    exit();
}
?>
<h1>Welcome, Seller!</h1>
<a href="logout.php">Logout</a>
