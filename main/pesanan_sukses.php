<?php
// Mulai session jika diperlukan
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .success-box {
            background: #ffffff;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .success-box i {
            font-size: 60px;
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="success-box">
        <i class="bi bi-check-circle-fill"></i>
        <h2 class="mt-3">Pesanan Berhasil!</h2>
        <p>Pesanan Anda telah dikirim ke dapur. Silakan tunggu pesanan Anda sedang disiapkan.</p>
        <a href="katalog.php" class="btn btn-success mt-3">
             Kembali ke Katalog
        </a>
    </div>
</body>
</html>
