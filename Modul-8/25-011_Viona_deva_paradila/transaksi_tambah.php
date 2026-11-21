<?php
require_once('connect.php');
require_once('middleware.php');

$level = $_SESSION['level'] ?? 0;
$nama_user = $_SESSION['nama'] ?? $_SESSION['username'] ?? 'User';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_transaksi = (int)$_POST['transaksi_id'];
    $barang_id = (int)$_POST['barang'];
    $qty = (int)$_POST['qty'];
    $deskripsi = mysqli_real_escape_string($con, $_POST['keterangan']);

    $queryBarang = mysqli_query($con, "SELECT harga FROM barang WHERE id = $barang_id");
    $barang = mysqli_fetch_assoc($queryBarang);
    $harga = $barang['harga'] * $qty;

    mysqli_query($con, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ($id_transaksi, $barang_id, $harga, $qty)");
    mysqli_query($con, "UPDATE transaksi SET total = (SELECT COALESCE(SUM(harga), 0) FROM transaksi_detail WHERE transaksi_id = $id_transaksi), keterangan = '$deskripsi' WHERE id = $id_transaksi");
} else {
    $pelangganDefault = 'PLG001';
    $cekPelanggan = mysqli_query($con, "SELECT id FROM pelanggan LIMIT 1");
    if ($cekPelanggan && mysqli_num_rows($cekPelanggan) > 0) {
        $pelRow = mysqli_fetch_assoc($cekPelanggan);
        $pelangganDefault = $pelRow['id'];
    }
    mysqli_query($con, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES (NOW(), '', 0, '$pelangganDefault')");
    $id_transaksi = mysqli_insert_id($con);
}

$data = mysqli_query($con, "SELECT td.*, b.nama_barang, td.harga AS total_harga FROM transaksi_detail td JOIN barang b ON b.id = td.barang_id WHERE td.transaksi_id = $id_transaksi");
$totalQuery = mysqli_query($con, "SELECT total, keterangan FROM transaksi WHERE id = $id_transaksi");
$totalData = mysqli_fetch_assoc($totalQuery);

$queryBarangList = mysqli_query($con, "SELECT b.* FROM barang b WHERE b.id NOT IN (SELECT td.barang_id FROM transaksi_detail td WHERE td.transaksi_id = $id_transaksi)");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi - Sistem Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="index.php">Sistem Penjualan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <?php if ($level == 1) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Data Master
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="barang.php">Data Barang</a></li>
                            <li><a class="dropdown-item" href="supplier.php">Data Supplier</a></li>
                            <li><a class="dropdown-item" href="pelanggan.php">Data Pelanggan</a></li>
                            <li><a class="dropdown-item" href="user.php">Data User</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="transaksi.php">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="laporan.php">Laporan</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                            <?= htmlspecialchars($nama_user) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4" style="max-width: 750px;">
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body p-4">
                <h3 class="card-title fw-bold text-dark mb-4">Detail Transaksi #<?= $id_transaksi ?></h3>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>NAMA BARANG</th>
                                <th class="text-center" style="width: 25%;">QUANTITY</th>
                                <th class="text-end" style="width: 30%;">HARGA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $has_item = false;
                            while ($row = mysqli_fetch_assoc($data)) {
                                $has_item = true;
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($row['qty']) ?></td>
                                    <td class="text-end">Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                                </tr>
                                <?php
                            }
                            if (!$has_item) {
                                echo '<tr><td colspan="3" class="text-center text-muted py-3">Belum ada barang pada transaksi ini.</td></tr>';
                            }
                            ?>
                            <tr class="table-light fw-bold">
                                <td>TOTAL</td>
                                <td colspan="2" class="text-end text-success fs-5">Rp <?= number_format($totalData['total'] ?? 0, 0, ',', '.') ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h4 class="h5 fw-bold text-dark mb-3">Tambah Item Barang</h4>
                <form action="" method="POST">
                    <input type="hidden" name="transaksi_id" value="<?= $id_transaksi ?>">
                    <div class="mb-3">
                        <label for="barang" class="form-label fw-semibold">Nama Barang</label>
                        <select name="barang" id="barang" class="form-select" required>
                            <option value="" disabled selected>Pilih Barang</option>
                            <?php while ($rowB = mysqli_fetch_assoc($queryBarangList)) { ?>
                                <option value="<?= $rowB['id'] ?>"><?= htmlspecialchars($rowB['nama_barang']) ?> - Rp <?= number_format($rowB['harga'], 0, ',', '.') ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="form-label fw-semibold">Quantity</label>
                        <input type="number" name="qty" id="qty" class="form-control" min="1" required>
                    </div>
                    <div class="mb-4">
                        <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3"><?= htmlspecialchars($totalData['keterangan'] ?? '') ?></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary px-4">Tambah Item</button>
                        <a href="transaksi.php" class="btn btn-success px-4">Selesai / Submit</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>