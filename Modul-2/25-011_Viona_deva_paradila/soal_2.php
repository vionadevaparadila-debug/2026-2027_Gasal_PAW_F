<?php
	
	$matkul = ["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];

	foreach ($matkul as $viona) {

		switch ($viona) {
			case 'PTI':
				echo "Saya suka $viona"."<br>";
				break;
			case 'ALPRO':
				echo "Saya suka $viona"."<br>";
				break;
			case 'DPW':
				echo "Saya suka $viona"."<br>";
				break;
			case 'STRUKDAT':
				echo "Saya suka $viona"."<br>";
				break;
			case 'JARKOM':
				echo "Saya suka $viona"."<br>";
				break;
			case 'PAW':
				echo "Saya suka $viona"."<br>";
				break;
			default:
				echo "Saya tidak mengambil matkul $viona"."<br>";
				break;
		};
	};

?>