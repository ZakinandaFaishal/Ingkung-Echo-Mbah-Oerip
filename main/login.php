<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    $_SESSION['user'] = [
    'first_name' => $user['first_name'],
    'level' => $user['level']
    ];

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        if($user['level']=='u'){
            echo "<script>alert('Login berhasil!'); window.location.href='index.php';</script>";
        } elseif($user['level']=='a'){
            echo "<script>alert('Login berhasil!'); window.location.href='./admin/index.php';</script>";
        } else{
            echo "<script>alert('Login berhasil!'); window.location.href='owner.php';</script>";
        }        
    } else {
        echo "<script>alert('Email atau password salah!');history.go(-1);</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Akun</title>
    <title>Daftar Akun - Ingkung Eco Mbah Oerip</title>
    <link rel="stylesheet" href="./assets/css/login.css">
</head>
<body>
    <div class="container">
        <img src="./assets/images/logo.png" alt="Logo" class="logo">
        <button class="back-button" onclick="history.back();">←</button>

        <h2>Selamat Datang Kembali!</h2>
        <p>Silahkan Login Untuk Memesan</p>

        <form method="POST" action="login.php">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Masukkan alamat email pribadi atau kantor" required>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" required>

            <div class="remember">
                <label><input type="checkbox" name="remember"> Ingat Saya</label>
                <a href="forgotpass.php" style="font-size: 13px; text-decoration: none;">Lupa Password</a>
            </div>

            <button type="submit" class="submit-button">Masuk</button>
        </form>

        <div class="divider">Atau masuk dengan :</div>

        <div class="social-buttons">
            <button>Google</button>
            <button>Apple</button>
            <button>Twitter</button>
        </div>

        <div class="register-link">
            Tidak Punya Akun? <a href="daftar.php">Daftar</a>
        </div>
    </div>
</body>
</html>
