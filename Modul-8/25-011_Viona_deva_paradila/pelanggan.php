<?php
require_once('connect.php');
require_once('middleware.php');

if ($_SESSION['level'] != 1) {
    header("Location: index.php");
    exit();
}

$level = $_SESSION['level'] ?? 0;
$nama_user = $_SESSION['nama'] ?? $_SESSION['username'] ?? 'User';

$query = mysqli_query($con, "SELECT * FROM pelanggan ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan - Sistem Penjualan</title>
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
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">
                            Data Master
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="barang.php">Data Barang</a></li>
                            <li><a class="dropdown-item" href="supplier.php">Data Supplier</a></li>
                            <li><a class="dropdown-item active" href="pelanggan.php">Data Pelanggan</a></li>
                            <li><a class="dropdown-item" href="user.php">Data User</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="transaksi.php">Transaksi</a>
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
            <h2 class="h4 fw-bold text-dark m-0">DATA PELANGGAN</h2>
        </div>
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 8%;">NO</th>
                                <th>ID PELANGGAN</th>
                                <th>NAMA</th>
                                <th>JENIS KELAMIN</th>
                                <th>TELEPON</th>
                                <th>ALAMAT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $has_data = false;
                            while ($row = mysqli_fetch_assoc($query)) {
                                $has_data = true;
                                $jk = ($row['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan';
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><span class="badge bg-secondary"><?= htmlspecialchars($row['id']) ?></span></td>
                                    <td><?= htmlspecialchars($row['nama']) ?></td>
                                    <td><?= $jk ?></td>
                                    <td><?= htmlspecialchars($row['telp'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($row['alamat'] ?? '-') ?></td>
                                </tr>
                                <?php
                            }
                            if (!$has_data) {
                                echo '<tr><td colspan="6" class="text-center text-muted py-4">Belum ada data pelanggan.</td></tr>';
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