<?php
include 'koneksi.php';

if (!isset($_GET['token'])) {
    die("Token tidak ditemukan!");
} 

$token = $_GET['token'];
$query = "SELECT * FROM users WHERE reset_token = '$token' AND token_expiry > NOW()";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form method="POST" action="simpan_password_baru.php">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
        <label>Password Baru</label><br>
        <input type="password" name="password_baru" required><br><br>
        <button type="submit">Simpan Password</button>
    </form>
</body>
</html>
<?php
} else {
    echo "Token tidak valid atau sudah kadaluarsa.";
}
?>
