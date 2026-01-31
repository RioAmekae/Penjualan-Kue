<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] !== "admin") {
    header("Location: ../login.php?pesan=Akses ditolak");
    exit;
}

include "../db.php";

// Ambil data pesanan + user
$pesanan = mysqli_query($conn, "
    SELECT o.id as order_id, u.username, o.order_date, o.status
    FROM orders o
    JOIN users u ON o.user_id = u.id
    ORDER BY o.order_date DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pesanan - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Data Pesanan</h3>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Tanggal Pesan</th>
                <th>Status</th>
                <th>Detail</th>
                <th>Ubah Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; while($row = mysqli_fetch_assoc($pesanan)): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['username']; ?></td>
                    <td><?= $row['order_date']; ?></td>
                    <td><?= $row['status']; ?></td>
                   <td>
                         <a href="pesanan_detail.php?id=<?= $row['order_id']; ?>" class="btn btn-info btn-sm">Lihat</a>
                    </td>
                    <td>
                        <form method="POST" action="ubah_status.php">
                            <input type="hidden" name="order_id" value="<?= $row['order_id']; ?>">
                            <select name="status" class="form-select form-select-sm d-inline w-auto">
                                <option value="pending" <?= $row['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="completed" <?= $row['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                            </select>
                            <button class="btn btn-sm btn-success">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
