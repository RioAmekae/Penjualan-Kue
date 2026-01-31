<?php
session_start();
include "../db.php";

if ($_SESSION['role'] !== "user") {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Buat order baru
mysqli_query($conn, "INSERT INTO orders (user_id) VALUES ($user_id)");
$order_id = mysqli_insert_id($conn);

// Tambah ke detail
mysqli_query($conn, "INSERT INTO order_details (order_id, product_id, quantity) 
                     VALUES ($order_id, $product_id, $quantity)");

header("Location: pesanan_saya.php");
