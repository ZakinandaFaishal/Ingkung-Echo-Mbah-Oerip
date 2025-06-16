<?php
session_start();
include '../koneksi.php';
if($_SESSION['user']['level'] != "a")
{

  echo '<script>
        alert("Maaf akses terbatas....");
        window.location.href="http://main.ingkungecombahoerip.web.id/index.php";
      </script>';
}
    //  window.location.href="http://localhost/mbah.oerip/main/index.php";
    //  window.location.href="http://main.ingkungecombahoerip.web.id/index.php";
// Hapus akun
if (isset($_GET['hapus'])) {
  $id = intval($_GET['hapus']);
  mysqli_query($conn, "DELETE FROM users WHERE id = $id");
  header("Location: akun.php");
  exit;
}

// Pagination setup
$limit = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

// Total data
$total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
$total_data = $total_query->fetch_assoc()['total'];
$total_pages = ceil($total_data / $limit);

// Ambil data user
$data = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC LIMIT $limit OFFSET $offset");

// Simpan data akun
if (isset($_POST['simpan'])) {
  $id = $_POST['id'] ?? '';
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $whatsapp = $_POST['whatsapp'];
  $level = $_POST['level'];
  $password = $_POST['password'];

  $pass_sql = $password ? ", password='" . password_hash($password, PASSWORD_DEFAULT) . "'" : "";

  if ($id) {
    $koneksi->query("UPDATE users SET 
      first_name='$first_name',
      last_name='$last_name',
      email='$email',
      whatsapp='$whatsapp',
      level='$level'
      $pass_sql
      WHERE id=$id");
  } else {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $koneksi->query("INSERT INTO users 
      (first_name, last_name, email, whatsapp, level, password)
      VALUES ('$first_name', '$last_name', '$email', '$whatsapp', '$level', '$hash')");
  }

  header("Location: akun.php");
  exit;
}

// Data edit
$edit = null;
if (isset($_GET['edit'])) {
  $id = intval($_GET['edit']);
  $edit = $koneksi->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Akun</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">

  <a href="index.php" class="btn btn-danger btn-md mb-3">Kembali</a>

  <div class="row">
    <!-- Form Tambah/Edit -->
    <div class="col-md-6">
      <h4><?= $edit ? 'Edit' : 'Tambah' ?> Akun</h4>
      <form method="post">
        <?php if ($edit): ?>
          <input type="hidden" name="id" value="<?= $edit['id'] ?>">
        <?php endif; ?>

        <input type="text" name="first_name" class="form-control mb-2" placeholder="Nama Depan" required value="<?= htmlspecialchars($edit['first_name'] ?? '') ?>">
        <input type="text" name="last_name" class="form-control mb-2" placeholder="Nama Belakang" value="<?= htmlspecialchars($edit['last_name'] ?? '') ?>">
        <input type="text" name="whatsapp" class="form-control mb-2" placeholder="No. WhatsApp" required value="<?= htmlspecialchars($edit['whatsapp'] ?? '') ?>">
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required value="<?= htmlspecialchars($edit['email'] ?? '') ?>">

        <select name="level" class="form-control mb-2" required>
          <option value="a" <?= ($edit['level'] ?? '') == 'a' ? 'selected' : '' ?>>Admin</option>
          <option value="o" <?= ($edit['level'] ?? '') == 'o' ? 'selected' : '' ?>>Owner</option>
          <option value="u" <?= ($edit['level'] ?? '') == 'u' ? 'selected' : '' ?>>User</option>
        </select>

        <input type="password" name="password" class="form-control mb-2" placeholder="Password <?= $edit ? '(kosongkan jika tidak ubah)' : '' ?>">

        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="akun.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>

    <!-- Tabel Daftar Akun -->
    <div class="col-md-6">
      <h4>Daftar Akun</h4>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Level</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $data->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= strtoupper($row['level']) ?></td>
              <td>
                <a href="akun.php?edit=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="akun.php?hapus=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus akun ini?')">Hapus</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>

      <!-- Pagination -->
      <nav>
        <ul class="pagination justify-content-center">
          <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
          </li>
          <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
              <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
          <?php endfor; ?>
          <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>

</body>
</html>
