<?php
session_start();
include '../koneksi.php';

// if($_SESSION['user']['level'] != "a")
// {
//   echo '<script>
//         alert("Maaf akses terbatas....");
//         window.location.href="http://localhost/mbah.oerip/main/index.php";
//       </script>';
// }

if($_SESSION['user']['level'] != "a")
{
  echo '<script>
        alert("Maaf akses terbatas....");
        window.location.href="http://main.ingkungecombahoerip.web.id/index.php";
      </script>';
}

// Tambah menu
if (isset($_POST['tambah'])) {
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $diskon = $_POST['diskon'] ?: 0;
  $kategori = $_POST['kategori'];
  $rating = $_POST['rating'] ?: 0;

  $harga_diskon = $harga - ($harga * ($diskon / 100));
  $gambar = $_FILES['gambar']['name'];
  $tmp = $_FILES['gambar']['tmp_name'];

  if ($gambar) {
    move_uploaded_file($tmp, "gambar/" . $gambar);
  }

  $conn->query("INSERT INTO menu (nama, harga, diskon, harga_diskon, kategori, gambar, rating)
                VALUES ('$nama', '$harga', '$diskon', '$harga_diskon', '$kategori', '$gambar', '$rating')");
  header("Location: menu.php");
  exit;
}

// Hapus menu
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  $data = $conn->query("SELECT gambar FROM menu WHERE id=$id")->fetch_assoc();
  if ($data['gambar']) unlink("gambar/" . $data['gambar']);
  $conn->query("DELETE FROM menu WHERE id=$id");
  header("Location: menu.php");
  exit;
}

$menu = $conn->query("SELECT * FROM menu");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Menu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-4">
  <a href="index.php" class="btn btn-danger btn-md mb-3">Kembali</a>
  <h2 class="mb-4 text-center">Manajemen Menu</h2>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Diskon</th>
        <th>Harga Diskon</th>
        <th>Kategori</th>
        <th>Rating</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $menu->fetch_assoc()): ?>
      <tr>
        <td>
          <?php if ($row['gambar']): ?>
            <img src="gambar/<?= $row['gambar'] ?>" width="70">
          <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td>Rp<?= number_format($row['harga']) ?></td>
        <td><?= $row['diskon'] ?>%</td>
        <td>Rp<?= number_format($row['harga_diskon'], 2) ?></td>
        <td><?= htmlspecialchars($row['kategori']) ?></td>
        <td><?= $row['rating'] ?> ⭐</td>
        <td>
          <a href="edit_menu.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="menu.php?hapus=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <h3 class="mt-5">Tambah Menu Baru</h3>
  <form method="post" enctype="multipart/form-data" class="row g-3 mt-2">
    <div class="col-md-3">
      <input type="text" name="nama" class="form-control" placeholder="Nama menu" required>
    </div>
    <div class="col-md-2">
      <input type="number" name="harga" class="form-control" placeholder="Harga" required>
    </div>
    <div class="col-md-2">
      <input type="number" name="diskon" class="form-control" placeholder="Diskon (%)">
    </div>
    <div class="col-md-2">
      <input type="text" name="kategori" class="form-control" placeholder="Kategori">
    </div>
    <div class="col-md-2">
      <input type="number" name="rating" class="form-control" placeholder="Rating (1-5)">
    </div>
    <div class="col-md-4">
      <input type="file" name="gambar" class="form-control">
    </div>
    <div class="col-12">
      <button type="submit" name="tambah" class="btn btn-primary">Tambah Menu</button>
    </div>
  </form>
</body>
</html>
