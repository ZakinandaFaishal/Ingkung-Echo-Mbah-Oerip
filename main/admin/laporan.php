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

$filter_awal = $_GET['awal'] ?? '';
$where_filter = "";
if (!empty($filter_awal)) {
  $where_filter = "AND created_at >= '" . mysqli_real_escape_string($conn, $filter_awal) . "'";
}

// Ambil semua bulan yang tersedia di data pesanan selesai
$bulan_query = mysqli_query($conn, "SELECT DISTINCT DATE_FORMAT(created_at, '%Y-%m') AS bulan FROM pesanan WHERE status='selesai' $where_filter ORDER BY bulan ASC");
$bulan_list = [];
while ($row = mysqli_fetch_assoc($bulan_query)) {
  $bulan_list[] = $row['bulan'];
}

// Ambil semua menu
$menu_query = mysqli_query($conn, "SELECT id, nama FROM menu");
$datasets = [];

while ($menu = mysqli_fetch_assoc($menu_query)) {
  $data = [];
  foreach ($bulan_list as $bln) {
    $stmt = mysqli_prepare($conn, "SELECT SUM(jumlah) as total FROM pesanan WHERE status='selesai' AND id_menu=? AND DATE_FORMAT(created_at, '%Y-%m')=? $where_filter");
    mysqli_stmt_bind_param($stmt, "is", $menu['id'], $bln);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $fetch = mysqli_fetch_assoc($res);
    $data[] = (int)($fetch['total'] ?? 0);
  }
  $datasets[] = [
    "label" => $menu['nama'],
    "data" => $data,
    "borderColor" => "rgba(" . rand(0,255) . "," . rand(0,255) . "," . rand(0,255) . ",1)",
    "tension" => 0.3,
    "fill" => false
  ];
}

// Ambil data statistik keseluruhan
$statistik = [];
$stat_query = mysqli_query($conn, "SELECT m.nama, SUM(p.jumlah) as total_jumlah, SUM(p.jumlah * m.harga) as total_pendapatan FROM pesanan p JOIN menu m ON p.id_menu = m.id WHERE p.status='selesai' $where_filter GROUP BY p.id_menu");
$total_semua = 0;
while ($row = mysqli_fetch_assoc($stat_query)) {
  $statistik[] = $row;
  $total_semua += $row['total_pendapatan'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Penjualan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="container py-5">
  <a href="index.php" class="btn btn-danger btn-md">Kembali</a>
  <br><h2 class="mb-4 text-center">Laporan Penjualan</h2>

  <form class="row g-3 mb-4" method="get">
    <div class="col-auto">
      <label for="awal" class="col-form-label">Mulai dari tanggal:</label>
    </div>
    <div class="col-auto">
      <input type="date" class="form-control" name="awal" id="awal" value="<?= htmlspecialchars($filter_awal) ?>">
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary">Tampilkan</button>
    </div>
  </form>

  <canvas id="grafik" height="100"></canvas>
  <script>
    const ctx = document.getElementById('grafik').getContext('2d');
    const chart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: <?= json_encode($bulan_list) ?>,
        datasets: <?= json_encode($datasets) ?>
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Tren Penjualan per Menu per Bulan'
          },
          tooltip: {
            mode: 'index',
            intersect: false
          }
        },
        interaction: {
          mode: 'nearest',
          axis: 'x',
          intersect: false
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

  <hr class="my-5">
  <h4>Statistik Penjualan Keseluruhan</h4>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Menu</th>
          <th>Jumlah Terjual</th>
          <th>Total Pendapatan</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($statistik as $row): ?>
        <tr>
          <td><?= htmlspecialchars($row['nama']) ?></td>
          <td><?= $row['total_jumlah'] ?></td>
          <td>Rp <?= number_format($row['total_pendapatan'], 0, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
        <tr class="table-secondary fw-bold">
          <td colspan="2">Total Pendapatan</td>
          <td>Rp <?= number_format($total_semua, 0, ',', '.') ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>
