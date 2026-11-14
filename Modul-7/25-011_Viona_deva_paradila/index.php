<?php
require_once('connect.php');



// fiterr : SELECT * FROM transaksi WHERE BETWEEN 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $awal = $_POST['tanggal_awal'];
    $akhir = $_POST['tanggal_akhir'];
    $filter = mysqli_query($con, "SELECT * FROM transaksi WHERE waktu_transaksi  BETWEEN '$awal' AND '$akhir'");
} else {
    $filter = mysqli_query($con, "SELECT * FROM transaksi");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>@media print { .no-print { display: none !important; } }</style>
</head>


    <h2>TRANSAKSI</h2>
    <form class="no-print" method="POST" action="">
        <input type="date" name="tanggal_awal" value="YYYY-MM-DD" placeholder="Tanggal Awal">
        <input type="date" name="tanggal_akhir" value="DD-MM-YYYY" placeholder="Tanggal Akhir">
        <a href=""><button>Tampilkan</button></a>
    </form>

    <button class="no-print" onclick="window.print()">Print</button>
    <a href="export.php?awal=<?=$awal?>&akhir=<?=$akhir?>"><button class="no-print">Excel</button></a>



    <table border="1" width="100%" heigh="100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>WAKTU TRANSAKSI</th>
                <th>KETERANGAN</th>
                <th>TOTAL</th>
                <th>ID PELANGGAN</th>
            </tr>
        </thead>
        <script>
            let tanggal = []
            let total = []
            // digunakan untuk soal nomer 3
            let p_unik = []
            let p_total = []
            // digunakan untuk soal nomer 3 END

        </script>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($filter)) {
                ?>
                <tr>
                    <script>
                        tanggal.push("<?= $row['waktu_transaksi'] ?>")
                        total.push("<?= $row['total'] ?>")
                    </script>
                    <td><?= $no++ ?></td>
                    <td><?= $row['waktu_transaksi'] ?></td>
                    <td><?= $row['keterangan'] ?></td>
                    <td><?= $row['total'] ?></td>
                    <td><?= $row['pelanggan_id'] ?></td>
                </tr>
                <?php
            }
            ?>

        </tbody>
    </table>
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {?>
    <div>
        <canvas id="myChart"></canvas>
    </div>
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

    <?php
    $card = mysqli_query($con, "SELECT DISTINCT transaksi.pelanggan_id, transaksi.pelanggan_id AS p_id , (SELECT SUM(transaksi.total) FROM transaksi WHERE transaksi.pelanggan_id= p_id) AS total FROM transaksi;");
    while($row=mysqli_fetch_assoc($card)){
        ?>
        <script>
            p_unik.push("<?= $row['pelanggan_id'] ?>")
            p_total.push("<?= $row['total'] ?>")
        </script>
        <?php
    }
    ?>
    <!-- SOAL NOMER 3 END -->
    <div>
        <canvas id="chart2"></canvas>
    </div>
 <?php }?> <!--tutupe nduwur -->
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