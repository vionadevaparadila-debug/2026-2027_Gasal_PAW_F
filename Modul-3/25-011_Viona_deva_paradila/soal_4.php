<?php

	// SOAL 4.1
	$height = array("Andy"=>"176","Barry"=>"165","Charlie"=>"170");
	$height += array("David" => "180","Ethan" => "172","Frank" => "168", "George" => "175", "Harry" => "182");

	var_dump($height);

	echo "<br>";
	echo "<br>";

	foreach ($height as $key => $value) {
		echo "$key is $value cm tall"."<br>";
	};

	echo "<br>";
	echo "<br>";
	

	// SOAL 4.2
	$weight = array("Andy"=>"70","Barry"=>"65","Charlie"=>"75");
	$idx1 = array_keys($weight);
	$idx2 = array_values($weight);
	for($x = 0; $x < count($weight);$x++){
		echo "$idx1[$x] is $idx2[$x] Kg"."<br>";
	};
?>