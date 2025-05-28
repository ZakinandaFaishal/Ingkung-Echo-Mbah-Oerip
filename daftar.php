<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Akun - Ingkung Eco Mbah Oerip</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .logo {
      width: 150px;
      margin-bottom: 20px;
    }
    p {
    color: #444;
    margin-bottom: 20px;
}

label {
    font-size: 14px;
    margin-bottom: 5px;
    display: block;
}
  </style>
</head>
<body class="bg-warning d-flex align-items-center justify-content-center min-vh-100">

  <div class="container text-center">
    <img src="./assets/images/logo.png" alt="Ingkung Eco Mbah Oerip" class="logo">
    <div class="card mx-auto shadow mb-5" style="max-width: 600px;">
      <div class="card-body text-start position-relative">

        <a href="login.php" class="btn btn-sm btn-danger position-absolute top-0 start-0 m-2">&larr;</a>

        <h1 class="h1 text-center mt-4">Daftar Akun</h1>
        <p class="text-center text-muted">Nikmati Pesanan Mudah Dan Cepat</p>

        <form action="proses_daftar.php" method="POST">
        <div class="row m-5">
          <div class="mb-3">
            <label for="whatsapp" class="form-label">Nomor Whatsapp</label>
            <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="Nomor Anda" required>
          </div>

          <div class="row mb-3">
            <div class="col-6">
              <label for="first_name" class="form-label">Nama Depan</label>
              <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Depan" required>
            </div>
            <div class="col-6">
              <label for="last_name" class="form-label">Nama Belakang</label>
              <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Belakang" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          </div>

          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
            <label class="form-check-label" for="terms">
              Saya menyetujui syarat dan ketentuan serta kebijakan privasi
            </label>
          </div>

          <button type="submit" class="btn btn-success w-100">Daftar</button>
        </form>

        <div class="text-center my-3">
          <span class="text-muted">Atau daftar dengan:</span>
        </div>

        <div class="d-flex justify-content-center gap-2 mb-3">
            <button class="btn btn-outline-danger d-flex align-items-center gap-2">
                <i class="bi bi-google"></i> Google
            </button>
            <button class="btn btn-outline-dark d-flex align-items-center gap-2">
                <i class="bi bi-apple"></i> Apple
            </button>
            <button class="btn btn-outline-primary d-flex align-items-center gap-2">
                <i class="bi bi-twitter"></i> Twitter
            </button>
        </div>


        <p class="text-center small">
          Sudah punya akun? <a href="login.php">Masuk</a>
        </p>

      </div>
    </div>
  </div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
