<?php
include '../db.php';

$result = mysqli_query($conn, "SELECT * FROM feedback");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lihat Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Daftar Feedback Pengguna</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Komentar</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['komentar']}</td>
                        <td>{$row['rating']}</td>
                      </tr>";
                $no++;
            }
            ?>
        </tb
