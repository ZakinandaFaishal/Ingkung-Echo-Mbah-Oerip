<?php
session_start();
include '../koneksi.php';
if($_SESSION['user']['level'] != "a")
{

  echo '<script>
        alert("Maaf akses terbatas....");
        window.location.href="http://localhost/mbah.oerip/main/index.php";
      </script>';
}
    //  window.location.href="http://localhost/mbah.oerip/main/index.php";
    //  window.location.href="http://main.ingkungecombahoerip.web.id/index.php";
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM menu WHERE id=$id")->fetch_assoc();

if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $diskon = $_POST['diskon'] ?: 0;
  $kategori = $_POST['kategori'];
  $rating = $_POST['rating'] ?: 0;
  $harga_diskon = $harga - ($harga * ($diskon / 100));

  if ($_FILES['gambar']['error'] === 0) {
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "gambar/" . $gambar);

    if (!empty($data['gambar']) && file_exists("gambar/" . $data['gambar'])) {
      unlink("gambar/" . $data['gambar']);
    }

    $query = "UPDATE menu SET nama='$nama', harga='$harga', diskon='$diskon', harga_diskon='$harga_diskon', kategori='$kategori', rating='$rating', gambar='$gambar' WHERE id=$id";
  } else {
    $query = "UPDATE menu SET nama='$nama', harga='$harga', diskon='$diskon', harga_diskon='$harga_diskon', kategori='$kategori', rating='$rating' WHERE id=$id";
  }

  mysqli_query($conn, $query);
  header("Location: menu.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Menu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h4>Edit Menu</h4>
    </div>
    <div class="card-body">
      <form method="post" enctype="multipart/form-data" class="row g-3">
        <div class="col-md-6">
          <label for="nama" class="form-label">Nama Menu</label>
          <input type="text" name="nama" id="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" required>
        </div>

        <div class="col-md-3">
          <label for="harga" class="form-label">Harga</label>
          <input type="number" name="harga" id="harga" class="form-control" value="<?= $data['harga'] ?>" required>
        </div>

        <div class="col-md-3">
          <label for="diskon" class="form-label">Diskon (%)</label>
          <input type="number" name="diskon" id="diskon" class="form-control" value="<?= $data['diskon'] ?>">
        </div>

        <div class="col-md-4">
          <label for="kategori" class="form-label">Kategori</label>
          <input type="text" name="kategori" id="kategori" class="form-control" value="<?= htmlspecialchars($data['kategori']) ?>">
        </div>

        <div class="col-md-2">
          <label for="rating" class="form-label">Rating (1–5)</label>
          <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" value="<?= $data['rating'] ?>">
        </div>

        <div class="col-md-6">
          <label for="gambar" class="form-label">Gambar Baru</label>
          <input type="file" name="gambar" id="gambar" class="form-control">
          <?php if (!empty($data['gambar'])): ?>
            <img src="gambar/<?= htmlspecialchars($data['gambar']) ?>" width="100" class="mt-2 border">
          <?php endif; ?>
        </div>

        <div class="col-12">
          <button type="submit" name="simpan" class="btn btn-success">Simpan Perubahan</button>
          <a href="menu.php" class="btn btn-secondary">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
