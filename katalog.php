<?php
session_start();
require 'koneksi.php';

$pesanan_user = [];
if (isset($_SESSION['user']['id'])) {
    $id_user = $_SESSION['user']['id'];
    $query_pesanan = "
        SELECT p.id_menu, m.nama
        FROM pesanan p
        JOIN menu m ON p.id_menu = m.id
        WHERE p.id_user = $id_user AND p.status = 'pending'
    ";
    $result_pesanan = $conn->query($query_pesanan);
    while ($row = $result_pesanan->fetch_assoc()) {
        $pesanan_user[] = $row['nama'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_ke_keranjang'])) {
    if (!isset($_SESSION['user']['id'])) {
        die("Anda belum login!");
    }

    $id_menu = intval($_POST['id_menu']);
    $jumlah = max(1, intval($_POST['jumlah']));
    $catatan = mysqli_real_escape_string($conn, $_POST['catatan']);
    $id_user = $_SESSION['user']['id'];

    $insert = "INSERT INTO pesanan (id_user, id_menu, jumlah, catatan, status)
               VALUES ($id_user, $id_menu, $jumlah, '$catatan', 'pending')";

    if (!mysqli_query($conn, $insert)) {
        die("Gagal menyimpan pesanan: " . mysqli_error($conn));
    }

    header("Location: katalog.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Katalog</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="../main/favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="../main/assets/css/style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Rubik:wght@400;500;600;700&family=Shadows+Into+Light&display=swap"
    rel="stylesheet">

  <!-- 
    - preload images
  -->
  <link rel="preload" as="image" href="../main/assets/images/hero-banner.png" media="min-width(768px)">
  <link rel="preload" as="image" href="../main/assets/images/hero-banner-bg.png" media="min-width(768px)">
  <link rel="preload" as="image" href="../main/assets/images/hero-bg.jpg">
  <link rel="stylesheet" href="../main/assets/css/font-awesome.min.css">
  <style>
    .menu-layout {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      margin-top: 2rem;
    }

    .menu-left {
      flex: 3;
      min-width: 600px;
    }

    .pesanan-kanan {
      flex: 1;
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 10px;
      max-height: 500px;
      overflow-y: auto;
      min-width: 250px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .pesanan-kanan h3 {
      margin-bottom: 15px;
      font-size: 20px;
      font-weight: bold;
      color: #222;
    }

    .pesanan-kanan ul {
      list-style-type: disc;
      padding-left: 20px;
    }

    .pesanan-kanan li {
      margin-bottom: 8px;
      color: #444;
    }
  </style>
</head>

<body id="top">

<?php
include 'header.php';
?>

  </header>
    <section class="hero" id="home" style="background-image: url('./assets/images/hero-bg.jpg')">
        <div class="container">

          <div class="hero-content">
            <h1 class="h1 hero-title">Daftar Menu</h1>
            <h2 class="h1 hero-title">Makanan Favorit 2025</h2>
            <p class="hero-text">Pilih Makanan Favorit Anda dan Pesan Dengan Mudah!</p>
          </div>

          <figure class="hero-banner">
            <img src="./assets/images/hero-banner-bg.png" width="820" height="716" alt="" aria-hidden="true"
              class="w-100 hero-img-bg">

            <img src="./assets/images/hero-banner.png" width="700" height="637" loading="lazy" alt="Burger"
              class="w-100 hero-img">
          </figure>
        </div>
    </section>
    <section class="section food-menu" id="food-menu">
      <div class="container">
        <ul class="fiter-list">

          <li>
            <button class="filter-btn active">Spesial Promo</button>
          </li>

          <li>
            <button class="filter-btn">Menu Utama</button>
          </li>

          <li>
            <button class="filter-btn">Makanan Ringan</button>
          </li>

          <li>
            <button class="filter-btn">Paket</button>
          </li>
          
          <li>
            <button class="filter-btn">Minuman</button>
          </li>
          
          <li>
            <button class="filter-btn">Jajanan</button>
          </li>

        </ul>

        <?php
        // Koneksi database
        include 'koneksi.php';

        // Ambil data menu
        $sql = "SELECT * FROM menu ORDER BY id DESC";
        $result = $conn->query($sql);
        ?>
       
      <!-- HTML bagian katalog -->
      <!-- #KATALOG -->
      <!-- Bungkus menu dan ringkasan pesanan -->
<div class="menu-layout">

  <!-- Bagian Kiri: Menu -->
  <div class="menu-left">
    <ul class="food-menu-list">
      <?php while($row = $result->fetch_assoc()): ?>          
        <li>
          <div class="food-menu-card">
            <div class="card-banner">
              <img src="../main/assets/images/<?= $row['gambar'] ?>" width="300" height="300" loading="lazy"
                alt="<?= htmlspecialchars($row['nama']) ?>" class="w-100">
              <div class="badge">-<?= $row['diskon'] ?>%</div>

              <?php if (isset($_SESSION['user']['id'])): ?>
                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%;">
                  <form method="post" action="katalog.php">
                    <input type="hidden" name="id_menu" value="<?= $row['id'] ?>">
                    <p>Masukkan Jumlah</p>
                    <input type="number" name="jumlah" value="1" min="1"><br>
                    <input type="text" name="catatan" placeholder="Catatan (opsional)"><br>
                    <button type="submit" name="tambah_ke_keranjang" class="btn">Order Now</button>
                  </form>
                </div>
              <?php else: ?>
                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%;">
                  <p><strong>Login untuk memesan</strong></p>
                  <button onclick="location.href='login.php'" class="btn">Login Sekarang</button>
                </div>
              <?php endif; ?>
            </div>

            <div class="wrapper">
              <p class="category"><?= htmlspecialchars($row['kategori']) ?></p>
              <div class="rating-wrapper">
                <?php for ($i = 0; $i < $row['rating']; $i++): ?>
                  <ion-icon name="star"></ion-icon>
                <?php endfor; ?>
              </div>
            </div>

            <h3 class="h3 card-title"><?= htmlspecialchars($row['nama']) ?></h3>

            <div class="price-wrapper">
              <p class="price-text">Price:</p>
              <data class="price" value="<?= $row['harga_diskon'] ?>">$<?= number_format($row['harga_diskon'], 2) ?></data>
              <del class="del">$<?= number_format($row['harga'], 2) ?></del>
            </div>
          </div>
        </li>
      <?php endwhile; ?>
    </ul>
  </div>

  <!-- Bagian Kanan: Ringkasan Pesanan -->
  <?php if (!empty($pesanan_user)): ?>
    <div class="pesanan-kanan">
      <h3>Pesanan Anda</h3>
      <ul>
        <?php foreach ($pesanan_user as $nama_menu): ?>
          <li><?= htmlspecialchars($nama_menu) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

</div>

        <?php $conn->close();?>
    </section>
  
<?php
include "footer.php";
?>