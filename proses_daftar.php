<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $whatsapp = htmlspecialchars($_POST['whatsapp']);
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password
    $terms = isset($_POST['terms']) ? 1 : 0;

    if (!$terms) {
        echo "<script>alert('Anda harus menyetujui syarat dan ketentuan.');history.go(-1);</script>";
        exit;
    }

    $sql = "INSERT INTO users (whatsapp, first_name, last_name, email, password) 
            VALUES ('$whatsapp', '$firstName', '$lastName', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Pendaftaran berhasil!'); window.location.href='login.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }   
}
?>
