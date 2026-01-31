<?php
session_start();
include "../db.php";

if ($_SESSION['role'] !== "admin") {
    header("Location: ../login.php");
    exit;
}

$order_id = $_POST['order_id'];
$status = $_POST['status'];

mysqli_query($conn, "UPDATE orders SET status='$status' WHERE id=$order_id");

header("Location: pesanan.php");
