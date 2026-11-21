<?php
require_once('connect.php');
require_once('middleware.php');

$level = $_SESSION['level'] ?? 0;
$nama_user = $_SESSION['nama'] ?? $_SESSION['username'] ?? 'User';

if (isset($_GET['hapus_transaksi'])) {
    $id_del = (int)$_GET['hapus_transaksi'];
    mysqli_query($con, "DELETE FROM transaksi_detail WHERE transaksi_id = $id_del");
    mysqli_query($con, "DELETE FROM transaksi WHERE id = $id_del");
    header("Location: transaksi.php");
    exit();
}

$require = mysqli_query($con, "SELECT * FROM transaksi ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Transaksi - Sistem Penjualan</title>
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

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 fw-bold text-dark m-0">MENU TRANSAKSI</h2>
            <div>
                <a href="transaksi_tambah.php" class="btn btn-primary shadow-sm">Tambah Data</a>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 8%;">NO</th>
                                <th>WAKTU TRANSAKSI</th>
                                <th>KETERANGAN</th>
                                <th>TOTAL</th>
                                <th>ID PELANGGAN</th>
                                <th class="text-center" style="width: 20%;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $has_data = false;
                            while ($row = mysqli_fetch_assoc($require)) {
                                $has_data = true;
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['waktu_transaksi']) ?></td>
                                    <td><?= htmlspecialchars($row['keterangan']) ?></td>
                                    <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                                    <td><span class="badge bg-secondary"><?= htmlspecialchars($row['pelanggan_id']) ?></span></td>
                                    <td class="text-center">
                                        <a href="transaksi_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning text-dark fw-semibold px-3 me-1">Edit</a>
                                        <a href="transaksi.php?hapus_transaksi=<?= $row['id'] ?>" class="btn btn-sm btn-danger px-3" onclick="return confirm('Apakah yakin ingin menghapus transaksi ini?')">Hapus</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            if (!$has_data) {
                                echo '<tr><td colspan="6" class="text-center text-muted py-4">Belum ada data transaksi.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>