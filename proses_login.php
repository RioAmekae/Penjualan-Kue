<?php
session_start();
include 'db.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if ($data) {
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    $_SESSION['role'] = $data['role'];
    $_SESSION['user_id'] = $data['id']; // Tambahkan baris ini

    if ($data['role'] == 'admin') {
        header("Location: admin/dashboard.php");
    } else if ($data['role'] == 'user') {
        header("Location: user/katalog.php");
    } else {
        // Jika role tidak dikenal
        header("Location: login.php?pesan=role_tidak_valid");
    }
} else {
    header("Location: login.php?pesan=gagal");
}
?>
