<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="./assets/css/login.css">
</head>
<body>
    <div class="container">
        <img src="logo.png" alt="Logo" class="logo">
        <button class="back-button" onclick="history.back();">←</button>

        <h2>Lupa Password Anda?</h2>
        <p>Tidak ada yang perlu dikhawatirkan, kami akan mengirimkan pesan untuk membantu Anda mengatur ulang kata sandi Anda.</p>

        <form method="POST" action="proses_lupa_password.php">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Masukkan alamat email pribadi atau kantor" required>
            <button type="submit" class="submit-button" href="proses_lupa_password.php">Send Reset Password</button>
        </form>
    </div>
</body>
</html>
