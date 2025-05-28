<?php
session_start();
include 'koneksi.php'; // Sekarang pakai MySQLi

$testimonials = [];

$sql = "SELECT name, title, youtube_video_id, profile_image FROM testimonials ORDER BY id ASC";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $testimonials[] = $row;
  }
} else {
  $testimonials = [];
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
  
</head>

<body id="top">

<?php
include 'header.php';
?>

<!-- 
        - #ABOUT
      -->

      <section class="section section-divider gray about" id="about" style="background-color: #F4C430;">
        <div class="container">

          <div class="about-banner">
            <img src="./assets/images/about-banner.png" width="509" height="459" loading="lazy" alt="Burger with Drinks"
              class="w-100 about-img">
          </div>

          <div class="about-content">

            <h2 class="h2 section-title">
              Tentang Ingkung 
              <span class="span">Eco Mbah Oerip</span>
            </h2>

            <p class="section-text" style="text-align:justify">
              Ingkung Makaryo Roso adalah usaha kuliner tradisional yang berlokasi di Mungkid, Magelang. 
			        Kami hadir membawa cita rasa ingkung ayam khas Jawa yang diolah menggunakan resep turun-temurun dan rempah-rempah pilihan. 
			        Bukan sekadar makanan, ingkung juga sarat makna sebagai simbol syukur dan doa dalam tradisi Jawa.
			  
            </p>

            <ul class="about-list">

              <li class="about-item">
                <ion-icon name="checkmark-outline"></ion-icon>

                <span class="span">Rasa Autentik</span>
              </li>

              <li class="about-item">
                <ion-icon name="checkmark-outline"></ion-icon>

                <span class="span">Harga bersahabat</span>
              </li>

              <li class="about-item">
                <ion-icon name="checkmark-outline"></ion-icon>

                <span class="span">Pesan Mudah</span>
              </li>

              <li class="about-item">
                <ion-icon name="checkmark-outline"></ion-icon>

                <span class="span">Masakan Tradisi</span>
              </li>

            </ul>

            <button onclick="location.href='katalog.php'" class="btn">Pesan Sekarang</button>
          </div>
        </div>
      </section>
      
      <!-- 
        - #TESTIMONIALS
      -->

<section class="section section-divider white testi">
  <div class="container">
    <div class="testimonial-grid">
      <?php foreach ($testimonials as $testimonial): ?>
        <div class="testi-card">
          <div class="profile-wrapper">
            <figure class="avatar">
              <img src="<?= $testimonial['profile_image'] ?>" width="60" height="60" alt="<?= $testimonial['name'] ?>">
            </figure>
            <div>
              <h3 class="h4 testi-name"><?= $testimonial['name'] ?></h3>
              <p class="testi-title"><?= $testimonial['title'] ?></p>
            </div>
          </div>

          <iframe 
            src="https://www.youtube.com/embed/<?= $testimonial['youtube_video_id'] ?>" 
            title="YouTube video testimonial" frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen>
          </iframe>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
include 'footer.php';
?>


        