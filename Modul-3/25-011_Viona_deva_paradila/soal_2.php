<?php

	// SOAL 2.1
	echo "SOAL 2.1"."<br>";
	$fruits = array("Avocado","Blueberry","Cherry");
	$panjang = array("Durian","Endelberry","Fig", "Grape","Honeydew");
	for($i = 0;$i < count($fruits);$i++){
		echo $fruits[$i]."<br>";

	};
	$arrlength = count($panjang);
	for($x = 0;$x < $arrlength;$x++) {
		echo "Buah tambahan".$x+1;
		echo "<br>";
		array_push($fruits,$panjang[$x]);
	};

	// alasan kenapa perulangan tersebut harus dirubah karena pada arrlength hanya memanggil jumlah data array di variabel $fruits yang hanya perjumlah 3, oleh karena itu untuk menambahkan 5 data baru pada array $fruits harus membuat variabel baru $panjang yang berisi 5 data baru yaitu $panjang = array("Durian","Endelberry","Fig", "Grape","Honeydew");, lalu ubah $arrlength = count($panjang); agar perulangan bisa dilakukan sebanyak 5x bukan 3kali.

	echo "<br>";
	// SOAL 2.2
	echo "SOAL 2.2"."<br>";
	$vegies = array("carrot","Broccoli","Spinach");
	for($i = 0;$i < count($vegies);$i++){
		echo $vegies[$i]."<br>";

	};

	// untuk soal nomer 2.2 saya cukup menambahkan variabel baru dengan isi 3 data $vegies = array("carrot","Broccoli","Spinach"); dan untuk perulangannya saya melakukan modifikasi code yang sudah ada, agar bisa mengefisiensi waktu.
?>