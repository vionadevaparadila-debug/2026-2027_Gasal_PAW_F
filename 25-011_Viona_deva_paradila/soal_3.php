<?php

	// SOAL NOMER 3.1
	echo "SOAL NOMER 3.1"."<br>";
	$height = array("Andy"=>"176","Barry"=>"165","Charlie"=>"170");
	$height += array("David" => 180,"Ethan" => 172,"Frank" => 168, "George" => 175, "Harry" => 182
	);
	var_dump($height)."<br>";
	echo "<br>";
	echo "Nilai dengan index terahir : ".$height[array_key_last($height)]."<br>";

	echo "<br>";

	// mehapus data list
	unset($height["Barry"]);
	var_dump($height);
	echo "<br>";
	echo "Nilai dengan index terahir setelah di hapus: ".($height[array_key_last($height)])."<br>";

	echo "<br>";

	// SOAL NOMER 3.2 
	echo "SOAL NOMER 3.2"."<br>";
	$weight = array("Andy"=>"70","Barry"=>"65","Charlie"=>"75");
	var_dump($weight);
	echo "<br>";
	echo "data kedua : ".$weight["Barry"];
?>