<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Cek apakah email terdaftar
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    //informasi domain, sesuaikan dengan domain server
    $domain = "http://main.ingkungecombahoerip.web.id";

    if (mysqli_num_rows($result) == 1) {
        // Generate token unik
        $token = bin2hex(random_bytes(50));

        // Simpan token ke database
        $update = "UPDATE users SET reset_token = '$token', token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = '$email'";
        mysqli_query($conn, $update);

        // Kirim email reset password
        $reset_link = $domain."/main/reset_password.php?token=$token";
        $subject = "Reset Password Anda";
        $message = "Klik link berikut untuk mereset password Anda: $reset_link\n\nLink berlaku selama 1 jam.";
        $headers = "From: no-reply@webmu.com";

        mail($email, $subject, $message, $headers);

        echo "<script>alert('Link reset password telah dikirim ke email Anda.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Email tidak ditemukan!'); window.location='forgotpass.php';</script>";
    }
}
?>
