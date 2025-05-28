<?php
session_start();
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
  
  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="hero" id="home" style="background-image: url('./assets/images/hero-bg.jpg')">
        <div class="container">

          <div class="hero-content">

            <h2 class="h1 hero-title">Ingkung Eco Mbah Oerip</h2>

            <p class="hero-text" style="text-align:justify">Nikmati kelezatan Ingkung dengan cita rasa khas yang menggugah selera. Dibuat
                                dari bahan-bahan berkualitas dengan resep turun-temurun,
                                Pesan dengan mudah dan nikmati pengalaman kuliner istimewa, langsung di meja Anda.</p>

            <button onclick="location.href='katalog.php'" class="btn">Pesan Sekarang</button>

          </div>

          <figure class="hero-banner">
            <img src="./assets/images/hero-banner-bg.png" width="820" height="716" alt="" aria-hidden="true"
              class="w-100 hero-img-bg">

            <img src="./assets/images/hero-banner.png" width="700" height="637" loading="lazy" alt="Burger"
              class="w-100 hero-img">
          </figure>

        </div>
      </section>

      <!-- 
        - #PROMO
      -->

      <section class="section section-divider white promo">
        <div class="container">

          <ul class="promo-list has-scrollbar">

            <li class="promo-item">
              <div class="promo-card">
				<i class="fa fa-smile-o fa-5x" style="color:#aa0530" aria-hidden="true"></i>
                <h3 class="h3 card-title">250+</h3>

                <p class="card-text">
                  Kepuasan Pelanggan
                </p>

                <!-- <img src="./assets/images/promo-1.png" width="300" height="300" loading="lazy" alt="Maxican Pizza"
                  class="w-100 card-banner"> -->

              </div>
            </li>

            <li class="promo-item">
              <div class="promo-card">

				<i class="fa fa-clock-o fa-5x" style="color:#aa0530" aria-hidden="true"></i>
                <h3 class="h3 card-title">Maksimal 30 Menit</h3>

                <p class="card-text">
                  Waktu Pengolahan Cepat
                </p>
                <!-- <img src="./assets/images/promo-2.png" width="300" height="300" loading="lazy" alt="Soft Drinks"
                  class="w-100 card-banner"> -->
              </div>
            </li>

            <li class="promo-item">
              <div class="promo-card">

                <div class="card-icon">
				<i class="fa fa-coffee fa-5x" style="color:#aa0530" aria-hidden="true"></i>
                <h3 class="h3 card-title">Mulai Rp. 25.000/porsi</h3>

                <p class="card-text">
                  Harga Kompetitif
                </p>
                <!-- <img src="./assets/images/promo-3.png" width="300" height="300" loading="lazy" alt="French Fry"
                  class="w-100 card-banner"> -->

              </div>
            </li>

            <li class="promo-item">
              <div class="promo-card">

				<div class="card-icon">
				<i class="fa fa-users fa-5x" style="color:#aa0530" aria-hidden="true"></i>
                <h3 class="h3 card-title">98% Pesanan</h3>

                <p class="card-text">
                  Ketepatan Pengiriman
                </p>
                <!-- <img src="./assets/images/promo-4.png" width="300" height="300" loading="lazy" alt="Burger Kingo"
                  class="w-100 card-banner"> -->

              </div>
            </li>

            <li class="promo-item">
              <div class="promo-card">

                <div class="card-icon">
				        <i class="fa fa-handshake-o fa-5x" style="color:#aa0530" aria-hidden="true"></i>
                <h3 class="h3 card-title">97% Cocok dilidah</h3>

                <p class="card-text">
                  Masakan Legendaris
                </p>
                <!-- <img src="./assets/images/promo-5.png" width="300" height="300" loading="lazy" alt="Chicken Masala"
                  class="w-100 card-banner"> -->

              </div>
            </li>

          </ul>

        </div>
      </section>

      <!-- 
        - #ABOUT
      -->

      <section class="section section-divider gray about" id="about">
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

            <p class="section-text"  style="text-align:justify">
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
        - #BLOG
      -->

      <section class="section section-divider white blog" id="blog">
        <div class="container">
        <h2 class="h2 section-title">
              Teman Disetiap
              <span class="span">Kebahagiaan</span>
            </h2>

          <br>
          <ul class="blog-list">

            <li>
              <div class="blog-card">

                <div class="card-banner">
                  <img src="https://pa-magelang.go.id/wp-content/uploads/2024/02/WhatsApp-Image-2024-02-22-at-12.45.49.jpeg" loading="lazy"
                    alt="Making Chicken Strips With New Delicious Ingridents." class="w-100">

                  <!-- <img src="./assets/images/blog-1.jpg" width="600" height="390" loading="lazy"
                    alt="What Do You Think About Cheese Pizza Recipes?" class="w-100"> -->

                  <div class="badge">News</div>
                </div>

                <div class="card-content">

                  <div class="card-meta-wrapper">
                    <a href="#" class="card-meta-link">
                      <ion-icon name="calendar-outline"></ion-icon>
                      <time class="meta-info" datetime="2022-01-01">Jan 01 2022</time>
                    </a>
                    
                    <a href="#" class="card-meta-link">
                      <ion-icon name="person-outline"></ion-icon>
                      <p class="meta-info">Jonathan Smith</p>
                    </a>
                  </div>

                  <h3 class="h3">
                    <a href="#" class="card-title">Pembekalan Kepala Desa Se-Magelang Raya</a>
                  </h3>

                  <p class="card-text">
                  Acara ini Dilakukan setalah adanya serah terima jabatan dari presiden indonesia, Bapak Prabowo Subianto                  </p>
                  <a href="#" class="btn-link">
                    <span>Read More</span>
                    <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                  </a>
                </div>
              </div>
            </li>

            <li>
              <div class="blog-card">

                <div class="card-banner">
                  <img src="https://pa-magelang.go.id/wp-content/uploads/2024/02/WhatsApp-Image-2024-02-22-at-12.45.49.jpeg" loading="lazy"
                    alt="Making Chicken Strips With New Delicious Ingridents." class="w-100">

              <!-- <img src="./assets/images/blog-1.jpg" width="600" height="390" loading="lazy"
                    alt="What Do You Think About Cheese Pizza Recipes?" class="w-100"> -->

                  <div class="badge">News</div>
                </div>

                <div class="card-content">

                  <div class="card-meta-wrapper">

                    <a href="#" class="card-meta-link">
                      <ion-icon name="calendar-outline"></ion-icon>

                      <time class="meta-info" datetime="2022-01-01">Jan 01 2022</time>
                    </a>

                    <a href="#" class="card-meta-link">
                      <ion-icon name="person-outline"></ion-icon>

                      <p class="meta-info">Jonathan Smith</p>
                    </a>

                  </div>

                  <h3 class="h3">
                    <a href="#" class="card-title">Fokcus Group Disscusion Disdukcapil Magelang</a>
                  </h3>

                  <p class="card-text">
                  Acara ini Dilakukan setalah adanya serah terima jabatan dari presiden indonesia, Bapak Prabowo Subianto                  </p>
                  <a href="#" class="btn-link">
                    <span>Read More</span>

                    <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                  </a>

                </div>

              </div>
            </li>

            <li>
              <div class="blog-card">

                <div class="card-banner">

                  <img src="https://pa-magelang.go.id/wp-content/uploads/2024/02/WhatsApp-Image-2024-02-22-at-12.45.49.jpeg" loading="lazy"
                    alt="Making Chicken Strips With New Delicious Ingridents." class="w-100">

                  <!-- <img src="./assets/images/blog-3.jpg" width="600" height="390" loading="lazy"
                    alt="Innovative Hot Chessyraw Pasta Make Creator Fact." class="w-100"> -->

                  <div class="badge">News</div>
                </div>

                <div class="card-content">

                  <div class="card-meta-wrapper">

                    <a href="#" class="card-meta-link">
                      <ion-icon name="calendar-outline"></ion-icon>

                      <time class="meta-info" datetime="2022-01-01">Jan 01 2022</time>
                    </a>

                    <a href="#" class="card-meta-link">
                      <ion-icon name="person-outline"></ion-icon>

                      <p class="meta-info">Jonathan Smith</p>
                    </a>

                  </div>

                  <h3 class="h3">
                    <a href="#" class="card-title">Upacara Hari Koperasi Ke-77 Kota Magelang</a>
                  </h3>

                  <p class="card-text">
                  Acara ini Dilakukan setalah adanya serah terima jabatan dari presiden indonesia, Bapak Prabowo Subianto                  </p>
                  <a href="#" class="btn-link">
                    <span>Read More</span>

                    <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                  </a>

                </div>

              </div>
            </li>
          </ul>
        </div>
      </section>
    </article>
  </main>
<?php
include 'footer.php';
?>