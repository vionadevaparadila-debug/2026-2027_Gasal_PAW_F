<?php
require_once('connect.php');
require_once('middleware.php');

$awal = $_GET['awal'] ?? '';
$akhir = $_GET['akhir'] ?? '';

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=laporan_penjualan.xls');

if (!empty($awal) && !empty($akhir)) {
    $query = mysqli_query($con, "SELECT * FROM transaksi WHERE waktu_transaksi BETWEEN '$awal' AND '$akhir' ORDER BY waktu_transaksi ASC");
} else {
    $query = mysqli_query($con, "SELECT * FROM transaksi ORDER BY waktu_transaksi ASC");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
</head>
<body>
    <h2>LAPORAN DATA TRANSAKSI</h2>
    <?php if (!empty($awal) && !empty($akhir)) { ?>
        <p>Periode: <?= htmlspecialchars($awal) ?> s/d <?= htmlspecialchars($akhir) ?></p>
    <?php } ?>
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <thead>
            <tr bgcolor="#f2f2f2">
                <th>NO</th>
                <th>WAKTU TRANSAKSI</th>
                <th>KETERANGAN</th>
                <th>TOTAL</th>
                <th>ID PELANGGAN</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['waktu_transaksi']) ?></td>
                    <td><?= htmlspecialchars($row['keterangan']) ?></td>
                    <td><?= $row['total'] ?></td>
                    <td><?= htmlspecialchars($row['pelanggan_id']) ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>