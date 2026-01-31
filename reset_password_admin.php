<?php
include "db.php";

$newPassword = password_hash("user123", PASSWORD_DEFAULT);

$query = "UPDATE users SET password='$newPassword' WHERE username='user1'";

if (mysqli_query($conn, $query)) {
    echo "Password admin berhasil direset ke: user123";
} else {
    echo "Gagal: " . mysqli_error($conn);
}
