<?php
session_start();
include "../db.php";

if (!isset($_SESSION['status']) || $_SESSION['role'] !== "user") {
    header("Location: ../login.php?pesan=Harus login sebagai user");
    exit;
}

$key = isset($_GET['key-search']) ? $_GET['key-search'] : '';
$query = "SELECT * FROM products WHERE name LIKE '%$key%'";
$produk = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Kue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card:hover {
            transform: scale(1.01);
            transition: 0.3s;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger px-3 shadow-sm">
    <a class="navbar-brand" href="#">Toko Kue</a>
    <div class="ms-auto d-flex gap-2">
        <a href="pesanan_saya.php" class="btn btn-outline-light btn-sm">Pesanan Saya</a>
        <a href="../logout.php" class="btn btn-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <h4 class="mb-4 text-center">Selamat datang, <strong><?= $_SESSION['username']; ?></strong>! Yuk pilih kue favoritmu 🍰</h4>
    
    <!-- Form Pencarian -->
    <form method="GET" class="d-flex mb-4 justify-content-center">
        <input type="text" name="key-search" class="form-control w-50 me-2 shadow-sm" placeholder="Cari kue lezat..." value="<?= htmlspecialchars($key); ?>">
        <button class="btn btn-success">Cari</button>
        
    </form>
<div class="text-end mt-3 mb-4">
    <a href="feedback.php" class="btn btn-outline-primary">Beri Feedback</a>
</div>

    <!-- Produk -->
    <div class="row">
        <?php if (mysqli_num_rows($produk) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($produk)): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="../assets/img/<?= $row['image']; ?>" class="card-img-top" style="height:220px; object-fit:cover">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['name']; ?></h5>
                            <p class="card-text text-danger fw-semibold">Rp <?= number_format($row['price']); ?></p>
                            <form action="pesan.php" method="POST">
                                <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
                                <input type="number" name="quantity" min="1" value="1" class="form-control mb-2" required>
                                <button class="btn btn-primary w-100">Pesan Sekarang</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <div class="alert alert-warning">Produk tidak ditemukan.</div>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
