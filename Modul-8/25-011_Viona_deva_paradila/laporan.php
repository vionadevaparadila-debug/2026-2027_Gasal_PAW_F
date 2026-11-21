<?php
require_once('connect.php');
require_once('middleware.php');

$level = $_SESSION['level'] ?? 0;
$nama_user = $_SESSION['nama'] ?? $_SESSION['username'] ?? 'User';

$awal = $_POST['tanggal_awal'] ?? '';
$akhir = $_POST['tanggal_akhir'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($awal) && !empty($akhir)) {
    $filter = mysqli_query($con, "SELECT * FROM transaksi WHERE waktu_transaksi BETWEEN '$awal' AND '$akhir' ORDER BY waktu_transaksi ASC");
    $queryRekap = mysqli_query($con, "SELECT total, waktu_transaksi FROM transaksi WHERE waktu_transaksi BETWEEN '$awal' AND '$akhir' ORDER BY waktu_transaksi ASC");
} else {
    $filter = mysqli_query($con, "SELECT * FROM transaksi ORDER BY waktu_transaksi ASC");
    $queryRekap = mysqli_query($con, "SELECT total, waktu_transaksi FROM transaksi ORDER BY waktu_transaksi ASC");
}

$card = mysqli_query($con, "SELECT DISTINCT transaksi.pelanggan_id, transaksi.pelanggan_id AS p_id, (SELECT SUM(transaksi.total) FROM transaksi WHERE transaksi.pelanggan_id = p_id) AS total FROM transaksi");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Sistem Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body class="bg-light">
    <div class="no-print">
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
                            <a class="nav-link" href="transaksi.php">Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="laporan.php">Laporan</a>
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
    </div>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 fw-bold text-dark m-0">LAPORAN PENJUALAN</h2>
            <div class="no-print">
                <button class="btn btn-outline-secondary me-2" onclick="window.print()">Print</button>
                <a href="export.php?awal=<?= urlencode($awal) ?>&akhir=<?= urlencode($akhir) ?>" class="btn btn-success">Export Excel</a>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4 no-print">
            <div class="card-body p-4">
                <form method="POST" action="" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="tanggal_awal" class="form-label fw-semibold">Tanggal Awal</label>
                        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="<?= htmlspecialchars($awal) ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label for="tanggal_akhir" class="form-label fw-semibold">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="<?= htmlspecialchars($akhir) ?>" required>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary px-4 w-100">Tampilkan Filter</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            let tanggal = [];
            let total = [];
            let p_unik = [];
            let p_total = [];
        </script>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h3 class="h5 fw-bold mb-3">Daftar Transaksi</h3>
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 8%;">NO</th>
                                <th>WAKTU TRANSAKSI</th>
                                <th>KETERANGAN</th>
                                <th>TOTAL</th>
                                <th>ID PELANGGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $has_rows = false;
                            while ($row = mysqli_fetch_assoc($filter)) {
                                $has_rows = true;
                                ?>
                                <script>
                                    tanggal.push("<?= $row['waktu_transaksi'] ?>");
                                    total.push("<?= $row['total'] ?>");
                                </script>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['waktu_transaksi']) ?></td>
                                    <td><?= htmlspecialchars($row['keterangan']) ?></td>
                                    <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                                    <td><span class="badge bg-secondary"><?= htmlspecialchars($row['pelanggan_id']) ?></span></td>
                                </tr>
                                <?php
                            }
                            if (!$has_rows) {
                                echo '<tr><td colspan="5" class="text-center text-muted py-4">Tidak ada data transaksi.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h3 class="h5 fw-bold mb-3">Grafik Pendapatan Transaksi</h3>
                <canvas id="myChart" style="max-height: 350px;"></canvas>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h3 class="h5 fw-bold mb-3">Rekapitulasi Penjualan Harian</h3>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0">
                        <thead class="table-secondary">
                            <tr>
                                <th style="width: 8%;">NO</th>
                                <th>TOTAL</th>
                                <th>WAKTU TRANSAKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $noR = 1;
                            $has_rekap = false;
                            while ($rowR = mysqli_fetch_assoc($queryRekap)) {
                                $has_rekap = true;
                                ?>
                                <tr>
                                    <td><?= $noR++ ?></td>
                                    <td>Rp <?= number_format($rowR['total'], 0, ',', '.') ?></td>
                                    <td><?= htmlspecialchars($rowR['waktu_transaksi']) ?></td>
                                </tr>
                                <?php
                            }
                            if (!$has_rekap) {
                                echo '<tr><td colspan="3" class="text-center text-muted py-3">Tidak ada data rekapitulasi.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php
        while ($rowC = mysqli_fetch_assoc($card)) {
            ?>
            <script>
                p_unik.push("<?= $rowC['pelanggan_id'] ?>");
                p_total.push("<?= $rowC['total'] ?>");
            </script>
            <?php
        }
        ?>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h3 class="h5 fw-bold mb-3">Grafik Total Belanja Per Pelanggan</h3>
                <canvas id="chart2" style="max-height: 350px;"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const canvas = document.querySelector("#myChart");
        const chart2 = document.querySelector("#chart2");

        if (canvas) {
            new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: tanggal,
                    datasets: [{
                        label: 'Total Pendapatan',
                        data: total,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        if (chart2) {
            new Chart(chart2, {
                type: 'bar',
                data: {
                    labels: p_unik,
                    datasets: [{
                        label: 'Total Pembelian Pelanggan',
                        data: p_total,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>