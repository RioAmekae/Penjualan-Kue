<?php
include '../db.php';

$pesan = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);        // pakai $conn
    $komentar = mysqli_real_escape_string($conn, $_POST['komentar']); // pakai $conn
    $rating = $_POST['rating'];

    $query = "INSERT INTO feedback (nama, komentar, rating) VALUES ('$nama', '$komentar', '$rating')";
    if (mysqli_query($conn, $query)) {
        $pesan = "Terima kasih atas feedback Anda!";
    } else {
        $pesan = "Gagal mengirim feedback.";
    }
}
?>
