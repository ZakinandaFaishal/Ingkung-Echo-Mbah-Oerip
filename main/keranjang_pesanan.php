<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['user']) || !isset($_SESSION['user']['id'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['user']['id'];

// Tangani aksi POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['hapus'])) {
        $id_pesanan = intval($_POST['id_pesanan']);
        mysqli_query($conn, "DELETE FROM pesanan WHERE id_pesanan = $id_pesanan AND id_user = $id_user");
    } elseif (isset($_POST['update_semua'])) {
        if (isset($_POST['id_pesanan'], $_POST['jumlah'], $_POST['catatan'])) {
            foreach ($_POST['id_pesanan'] as $i => $id) {
                $id = intval($id);
                $jumlah = max(1, intval($_POST['jumlah'][$i]));
                $catatan = mysqli_real_escape_string($conn, $_POST['catatan'][$i]);
                mysqli_query($conn, "UPDATE pesanan SET jumlah = $jumlah, catatan = '$catatan' WHERE id_pesanan = $id AND id_user = $id_user");
            }
        }
    } elseif (isset($_POST['simpan_semua'])) {
        mysqli_query($conn, "UPDATE pesanan SET status = 'dipesan' WHERE status = 'pending' AND id_user = $id_user");
        header("Location: pesanan_sukses.php");
        exit;
    }else {
        die("Gagal menyimpan pesanan: " . mysqli_error($conn));
    }
}

// Ambil data pesanan
$query = "
    SELECT p.id_pesanan, m.nama, m.harga, p.jumlah, p.catatan
    FROM pesanan p
    JOIN menu m ON p.id_menu = m.id
    WHERE p.status = 'pending' AND p.id_user = $id_user
";
$result = mysqli_query($conn, $query);
if (!$result) die("Query error: " . mysqli_error($conn));

$pesanan = [];
$total_harga = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $pesanan[] = $row;
    $total_harga += $row['harga'] * $row['jumlah'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        form.hapus-form {
            display: none;
        }
    </style>
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4 text-center">Keranjang Pesanan</h2>

    <?php if (empty($pesanan)): ?>
        <div class="alert alert-warning text-center">Tidak ada pesanan saat ini.</div>
    <?php else: ?>
        <form method="post">
            <div class="table-responsive">
                <table class="table table-bordered bg-white align-middle">
                    <thead class="table-warning text-center">
                        <tr>
                            <th>Menu</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Catatan</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pesanan as $i => $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['nama']) ?></td>
                                <td class="text-end">Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                <td style="width: 80px;">
                                    <input type="number" name="jumlah[]" class="form-control" value="<?= $item['jumlah'] ?>" min="1">
                                </td>
                                <td>
                                    <input type="text" name="catatan[]" class="form-control" value="<?= htmlspecialchars($item['catatan']) ?>">
                                </td>
                                <td class="text-end">Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?></td>
                                <td class="text-center">
                                    <input type="hidden" name="id_pesanan[]" value="<?= $item['id_pesanan'] ?>">

                                    <button type="button" class="btn btn-danger btn-sm" title="Hapus" onclick="hapusPesanan(<?= $item['id_pesanan'] ?>)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="table-secondary">
                            <td colspan="4" class="text-end"><strong>Total:</strong></td>
                            <td class="text-end"><strong>Rp <?= number_format($total_harga, 0, ',', '.') ?></strong></td>
                            <td>
                                <button type="submit" name="update_semua" class="btn btn-success w-100">
                                    <i class="bi bi-arrow-repeat me-1 "></i> Update Semua
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            
        </form>

        <form method="post" class="text-end mt-3">
            <button type="submit" name="simpan_semua" class="btn btn-primary">
                <i class="bi bi-send-check me-1"></i> Simpan Pesanan
            </button>
        </form>

    <?php endif; ?>

    <div class="mt-3">
        <a href="katalog.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Katalog
        </a>
    </div>

    <!-- Hidden form untuk hapus -->
    <form method="post" id="hapusForm" class="hapus-form">
        <input type="hidden" name="id_pesanan" id="hapusId">
        <input type="hidden" name="hapus" value="1">
    </form>
</div>

<script>
function hapusPesanan(id) {
    if (confirm("Hapus item ini?")) {
        document.getElementById('hapusId').value = id;
        document.getElementById('hapusForm').submit();
    }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
