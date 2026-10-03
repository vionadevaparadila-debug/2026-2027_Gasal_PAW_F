<?php
    $matkul = ["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];
    $praktikum = ["JARKOM","PAW"];

    $jumlah_MK = count($matkul);
    $jumlah_P = count($praktikum);

    for($i = 0; $i < $jumlah_MK;$i++){
        if(in_array($matkul[$i], $praktikum)){
            echo "Saya sedang mengambil matkul $matkul[$i] termasuk praktikumnya"."<br>";
        }elseif ($i == 6 || $i == 7) {
            echo "Saya belum mengambil matkul $matkul[$i]"."<br>";
        }else{
            echo " Saya sudah mengambil matkul $matkul[$i] semester lalu"."<br>";
        };
    };
?>
