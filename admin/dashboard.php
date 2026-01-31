<?php
session_start();
include '../db.php';

// Cek apakah sudah login sebagai admin
if ($_SESSION['status'] != "login" || $_SESSION['role'] != "admin") {
    header("location:../Login/login.php?pesan=akses_ditolak");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Toko Kue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card:hover {
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            transform: scale(1.02);
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark px-4">
        <span class="navbar-brand mb-0 h1">Dashboard Admin</span>
        <a href="../Login/logout.php" class="btn btn-danger">Logout</a>
    </nav>

    <!-- Content -->
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Selamat Datang, Admin!</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <a href="produk.php" class="text-decoration-none">
                    <div class="card text-center p-4 bg-primary text-white">
                        <h4>Kelola Produk</h4>
                        <p>Tambah, edit, dan hapus produk</p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="pesanan.php" class="text-decoration-none">
                    <div class="card text-center p-4 bg-warning text-dark">
                        <h4>Daftar Pesanan</h4>
                        <p>Lihat dan proses pesanan pelanggan</p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="lihat_feedback.php" class="text-decoration-none">
                    <div class="card text-center p-4 bg-info text-white">
                        <h4>Feedback</h4>
                        <p>Lihat komentar dan ulasan pelanggan</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
