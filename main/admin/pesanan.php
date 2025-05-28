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

// Update status pesanan jika diperlukan
if (isset($_GET['status']) && isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $status = $_GET['status'];
  if (in_array($status, ['pending', 'dipesan', 'selesai'])) {
    mysqli_query($conn, "UPDATE pesanan SET status='$status' WHERE id_pesanan=$id");
  }
  header("Location: pesanan.php?page=" . ($_GET['page'] ?? 1));
  exit;
}

// Pagination
$limit = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

$total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM pesanan");
$total_data = $total_query->fetch_assoc()['total'];
$total_pages = ceil($total_data / $limit);

// Ambil data pesanan
$data = mysqli_query($conn, "
  SELECT p.*, m.nama AS nama_menu, u.first_name, u.last_name 
  FROM pesanan p 
  JOIN menu m ON p.id_menu = m.id 
  JOIN users u ON p.id_user = u.id 
  ORDER BY p.id_pesanan DESC 
  LIMIT $limit OFFSET $offset
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Pesanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
  <a href="index.php" class="btn btn-danger mb-3">Kembali</a>
  <h2 class="text-center mb-4">Daftar Pesanan</h2>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Menu</th>
        <th>Pemesan</th>
        <th>Jumlah</th>
        <th>Catatan</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $data->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id_pesanan'] ?></td>
        <td><?= $row['nama_menu'] ?></td>
        <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
        <td><?= $row['jumlah'] ?></td>
        <td><?= $row['catatan'] ?></td>
        <td>
        <?php
        $status = $row['status'];
        $badgeColor = 'secondary'; // default

        switch ($status) {
            case 'dipesan':
                $badgeColor = 'warning';
                break;
            case 'selesai':
                $badgeColor = 'success';
                break;
            // default sudah diset ke 'secondary'
        }
        ?>
        <span class="badge bg-<?= $badgeColor ?>">

            <?= ucfirst($row['status']) ?>
          </span>
        </td>
        <td>
          <div class="btn-group">
            <?php if ($row['status'] !== 'pending'): ?>
              <a href="?id=<?= $row['id_pesanan'] ?>&status=pending&page=<?= $page ?>" class="btn btn-sm btn-outline-secondary">Pending</a>
            <?php endif; ?>
            <?php if ($row['status'] !== 'dipesan'): ?>
              <a href="?id=<?= $row['id_pesanan'] ?>&status=dipesan&page=<?= $page ?>" class="btn btn-sm btn-outline-warning">Dipesan</a>
            <?php endif; ?>
            <?php if ($row['status'] !== 'selesai'): ?>
              <a href="?id=<?= $row['id_pesanan'] ?>&status=selesai&page=<?= $page ?>" class="btn btn-sm btn-outline-success">Selesai</a>
            <?php endif; ?>
          </div>
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

</body>
</html>

