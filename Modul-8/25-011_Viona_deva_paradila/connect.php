<?php
$con = mysqli_connect("localhost", "root", "", "penjualan");

if (!$con) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$conn = $con;

function getUserTable($con) {
    $res = mysqli_query($con, "SHOW TABLES LIKE 'users'");
    if ($res && mysqli_num_rows($res) > 0) {
        return 'users';
    }
    return 'user';
}
?>