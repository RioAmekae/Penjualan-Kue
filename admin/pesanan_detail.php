<?php
session_start();
include "../db.php";

// Periksa role dan login
if ($_SESSION['role'] !== "admin") {
    header("Location: ../login.php");
    exit;
}

// Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID pesanan tidak valid");
}
$id = (int)$_GET['id'];

// Query detail dengan prepared statement
$detail_query = "
    SELECT p.name, od.quantity, p.price, (od.quantity * p.price) AS total
    FROM order_details od
    JOIN products p ON od.product_id = p.id
    WHERE od.order_id = ?
";
$stmt = mysqli_prepare($conn, $detail_query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$detail = mysqli_stmt_get_result($stmt);

if (!$detail) {
    die("Error: " . mysqli_error($conn));
}

// Query total
$total_query = "
    SELECT SUM(od.quantity * p.price) AS total_bayar
    FROM order_details od
    JOIN products p ON od.product_id = p.id
    WHERE od.order_id = ?
";
$stmt = mysqli_prepare($conn, $total_query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$total_result = mysqli_stmt_get_result($stmt);
$total_row = mysqli_fetch_assoc($total_result);
$total = $total_row['total_bayar'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h4>Detail Pesanan #<?= htmlspecialchars($id); ?></h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Kue</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($detail) == 0): ?>
                <tr><td colspan="4">Tidak ada detail pesanan</td></tr>
            <?php else: ?>
                <?php while($row = mysqli_fetch_assoc($detail)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <td><?= htmlspecialchars($row['quantity']); ?></td>
                        <td>Rp <?= number_format($row['price'], 0, ',', '.'); ?></td>
                        <td>Rp <?= number_format($row['total'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Total Bayar:</th>
                <th>Rp <?= number_format($total, 0, ',', '.'); ?></th>
            </tr>
        </tfoot>
    </table>
    <a href="pesanan.php" class="btn btn-secondary">Kembali</a>
</div>
</body>
</html>