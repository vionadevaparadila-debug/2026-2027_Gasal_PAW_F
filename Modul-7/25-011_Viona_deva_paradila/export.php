<?php
require_once('connect.php');


$awal = $_GET['awal'];
$akhir = $_GET['akhir'];
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=viona.xls');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>@media print { .no-print { display: none !important; } }</style>
</head>

    <!-- SOAL NOMER 3 -->
    <?php
    $query = mysqli_query($con, "SELECT total, waktu_transaksi FROM transaksi WHERE waktu_transaksi BETWEEN '$awal' AND '$akhir'");

    ?>
    <table border="1" width="100%" heigh="100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>TOTAL</th>
                <th>WAKTU TRANSAKSI</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['total'] ?></td>
                    <td><?= $row['waktu_transaksi'] ?></td>
                </tr>
                <?php
            }
            ?>


        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const canvas = document.querySelector("#myChart");
        const chart2 = document.querySelector("#chart2");
        new Chart(canvas, {
            type: 'bar',
            data: {
                labels: tanggal,
                datasets: [{
                    label: 'total pendapatan',
                    data: total,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        new Chart(chart2, {
            type: 'bar',
            data: {
                labels: p_unik, //pelangan unik
                datasets: [{
                    label: 'total pendapatan',
                    data: p_total, // total seng de e tuku
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    </body>

</html>