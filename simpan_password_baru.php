<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $password_baru = password_hash($_POST['password_baru'], PASSWORD_DEFAULT);

    $query = "SELECT * FROM users WHERE reset_token = '$token' AND token_expiry > NOW()";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Simpan password baru dan hapus token
        $update = "UPDATE users SET password = '$password_baru', reset_token = NULL, token_expiry = NULL WHERE reset_token = '$token'";
        mysqli_query($conn, $update);

        echo "<script>alert('Password berhasil direset. Silakan login.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Token tidak valid atau kadaluarsa.'); window.location='forgotpass.php';</script>";
    }
}
?>
