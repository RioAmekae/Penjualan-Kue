<?php
session_start();
include "../db.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id=$id"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];

    if ($_FILES['gambar']['name'] != "") {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../assets/img/" . $gambar);
        $update = "UPDATE products SET name='$nama', price='$harga', image='$gambar' WHERE id=$id";
    } else {
        $update = "UPDATE products SET name='$nama', price='$harga' WHERE id=$id";
    }

    mysqli_query($conn, $update);
    header("Location: produk.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Edit Produk</h3>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Nama Kue</label>
            <input type="text" name="nama" class="form-control" value="<?= $data['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="<?= $data['price']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Gambar (kosongkan jika tidak ganti)</label>
            <input type="file" name="gambar" class="form-control">
            <small>Gambar saat ini: <?= $data['image']; ?></small>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="produk.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
