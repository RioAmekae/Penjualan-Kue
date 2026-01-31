<?php
session_start();
include "../db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp, "../assets/img/" . $gambar);

    $query = "INSERT INTO products (name, price, image) VALUES ('$nama', '$harga', '$gambar')";
    mysqli_query($conn, $query);

    header("Location: produk.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Tambah Produk</h3>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Nama Kue</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control" required>
        </div>
        <button class="btn btn-success">Simpan</button>
        <a href="produk.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
