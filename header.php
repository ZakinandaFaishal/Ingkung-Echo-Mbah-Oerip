 
 <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ingkung Eco Mbah Oerip - Jagonya Ingkung dan Tumpeng Borobudur</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">

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
  <link rel="preload" as="image" href="./assets/images/hero-banner.png" media="min-width(768px)">
  <link rel="preload" as="image" href="./assets/images/hero-banner-bg.png" media="min-width(768px)">
  <link rel="preload" as="image" href="./assets/images/hero-bg.jpg">
  <link rel="stylesheet" href="./assets/css/font-awesome.min.css">


</head>

<body id="top">
 <!--- #HEADER -->

  <header class="header" data-header>
    <div class="container">
      
        <a href="#" class="logo">
			  <span class="span">
					<img src="./assets/images/logo.png" width="100" height="90">
			  </span>
		    </a>

      <?php
      if (isset($_SESSION['user']['first_name'])) 
      {
          echo "<a class='navbar-link'>Selamat Datang, ".$_SESSION['user']['first_name']." !</a>";
      }    
      ?>

      <nav class="navbar" data-navbar>
        <ul class="navbar-list">

          <li class="nav-item">
            <a href="index.php?from=a" class="navbar-link" data-nav-link>Beranda</a>
          </li>

          <li class="nav-item">
            <a href="review.php?from=a" class="navbar-link" data-nav-link>Tentang Kami</a>
          </li>

          <li class="nav-item">
            <a href="katalog.php?from=a" class="navbar-link" data-nav-link>Katalog</a>
          </li>

          <li class="nav-item">
            <a href="kontak.php?from=a" class="navbar-link" data-nav-link>Kontak</a>
          </li>

          <li class="nav-item">
            <a href="keranjang_pesanan.php?from=a" class="navbar-link" data-nav-link>
              <i class="bi bi-cart-fill"></i>
            </a>
          </li>
          
        </ul>
      </nav>

      <div class="header-btn-group">
        <button class="nav-toggle-btn" aria-label="Toggle Menu" data-menu-toggle-btn>
          <span class="line top"></span>
          <span class="line middle"></span>
          <span class="line bottom"></span>
        </button>
      </div>
      
      <?php
      if (!isset($_SESSION['user']['first_name'])) 
      {
        echo '<button onclick="location.href=\'login.php\'" class="btn">Sign In</button>';
      }
      else
      {
          echo '<button onclick="location.href=\'logout.php\'" class="btn">Sign Out</button>';
      }   
      ?>
      
      <?php 
      if (isset($_SESSION['user']['level']) && $_SESSION['user']['level'] === 'admin') {
        echo '<form action="admin/index.php" method="get">
                <button type="submit" class="btn">Dashboard</button>
              </form>';
      }
      ?>

    </div>
  </header>

  <!-- 
    - #SEARCH BOX
  -->

  <div class="search-container" data-search-container>

    <div class="search-box">
      <input type="search" name="search" aria-label="Search here" placeholder="Type keywords here..."
        class="search-input">

      <button class="search-submit" aria-label="Submit search" data-search-submit-btn>
        <ion-icon name="search-outline"></ion-icon>
      </button>
    </div>

    <button class="search-close-btn" aria-label="Cancel search" data-search-close-btn></button>

  </div>