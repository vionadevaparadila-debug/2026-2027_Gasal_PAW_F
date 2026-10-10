<?php

	// Soal nomer 1.1

	echo "SOAL NOMER 1.1"."<br>";

	$fruits = array("Avocado","Blueberry","Cherry");
	array_push($fruits,"Durian","Endelberry","Fig","Grape","Honeydew");
	var_dump($fruits)."<br>";
	echo "Nilai dengan Index tertinggi : ".$fruits[count($fruits) -1]."<br>";
	echo "<br>";
	// Soal nomer 1.2
	echo "SOAL NOMER 1.2"."<br>";
	array_unshift($fruits, "Blueberry");
	var_dump($fruits)."<br>";
	echo "Nilai dengan Index tertinggi : ".$fruits[count($fruits) -1]."<br>";
?>