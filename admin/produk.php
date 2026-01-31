<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] !== "login" || $_SESSION['role'] !== "admin") {
    header("Location: ../login.php?pesan=Akses ditolak");
    exit;
}
include "../db.php";
$produk = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Produk - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Kelola Produk Kue</h3>
    <a href="tambah_produk.php" class="btn btn-primary mb-3">+ Tambah Produk</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Kue</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; while($row = mysqli_fetch_assoc($produk)): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['name']; ?></td>
                <td>Rp <?= number_format($row['price']); ?></td>
                <td><img src="../assets/img/<?= $row['image']; ?>" width="70"></td>
                <td>
                    <a href="edit_produk.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus_produk.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
