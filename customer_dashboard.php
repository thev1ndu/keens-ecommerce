<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'customer') {
    header("Location: login.php");
    exit();
}
?>
<h1>Welcome, Customer!</h1>
<a href="logout.php">Logout</a>
