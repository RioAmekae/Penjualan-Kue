<?php
session_start();
include "../db.php";

if ($_SESSION['role'] !== "user") {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$orders = mysqli_query($conn, "
    SELECT o.id as order_id, o.order_date, o.status, p.name, od.quantity, p.price 
    FROM orders o
    JOIN order_details od ON o.id = od.order_id
    JOIN products p ON od.product_id = p.id
    WHERE o.user_id = $user_id
    ORDER BY o.order_date DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h4>Pesanan Saya</h4>
    <a href="katalog.php" class="btn btn-secondary btn-sm mb-3">← Kembali ke Katalog</a>
    
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($orders)): ?>
                <tr>
                    <td><?= $row['order_date']; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['quantity']; ?></td>
                    <td>Rp <?= number_format($row['quantity'] * $row['price']); ?></td>
                    <td><?= $row['status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>