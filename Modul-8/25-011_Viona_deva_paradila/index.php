<?php
require_once('connect.php');
require_once('middleware.php');

$level = $_SESSION['level'] ?? 0;
$nama_user = $_SESSION['nama'] ?? $_SESSION['username'] ?? 'User';
$role_name = ($level == 1) ? 'Owner' : 'Kasir';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sistem Penjualan</title>
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
                        <a class="nav-link active" href="index.php">Home</a>
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
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-5 text-center">
                <h1 class="display-6 fw-bold mb-3">Selamat Datang, <?= htmlspecialchars($nama_user) ?></h1>
                <p class="lead text-muted mb-4">Anda masuk sebagai <span class="badge bg-primary fs-6"><?= $role_name ?> (Level <?= $level ?>)</span></p>
                <hr class="my-4">
                <p class="mb-0">Silakan gunakan menu navigasi di atas untuk mengakses fitur sistem.</p>
            </div>
        </div>
        <div class="row g-4">
            <?php if ($level == 1) { ?>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center p-4">
                        <h5 class="fw-bold">Data Barang</h5>
                        <p class="text-muted small">Tampilkan daftar master barang dagangan.</p>
                        <a href="barang.php" class="btn btn-outline-primary btn-sm">Lihat Data</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center p-4">
                        <h5 class="fw-bold">Data Supplier</h5>
                        <p class="text-muted small">Tampilkan daftar master pemasok barang.</p>
                        <a href="supplier.php" class="btn btn-outline-primary btn-sm">Lihat Data</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center p-4">
                        <h5 class="fw-bold">Data Pelanggan</h5>
                        <p class="text-muted small">Tampilkan daftar master pelanggan toko.</p>
                        <a href="pelanggan.php" class="btn btn-outline-primary btn-sm">Lihat Data</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center p-4">
                        <h5 class="fw-bold">Data User</h5>
                        <p class="text-muted small">Kelola data master akun pengguna (CRUD).</p>
                        <a href="user.php" class="btn btn-outline-primary btn-sm">Kelola User</a>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center p-4">
                        <h5 class="fw-bold">Transaksi</h5>
                        <p class="text-muted small">Kelola pencatatan transaksi penjualan kasir.</p>
                        <a href="transaksi.php" class="btn btn-primary btn-sm">Buka Transaksi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center p-4">
                        <h5 class="fw-bold">Laporan</h5>
                        <p class="text-muted small">Lihat laporan rekapitulasi, cetak, dan grafik.</p>
                        <a href="laporan.php" class="btn btn-success btn-sm">Buka Laporan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>