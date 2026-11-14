<?php
$con = mysqli_connect('localhost','root','','penjualan');

    if(!$con){
        die("koneksi gagal!".mysqli_connect_error());
    }


?>