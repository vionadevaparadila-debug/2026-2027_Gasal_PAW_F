<?php

	$student = array(
		array("Alex", "220401", "0812345678"),
		array("Bianca", "220402", "0812345687"),
		array("Candice", "220403", "0812345665")
	);

	$student_baru = array(
		array("Daniel", "220404", "0812345611"),
		array("Elena", "220405", "0812345622"),
		array("Fiona", "220406", "0812345633"),
		array("Gabe", "220407", "0812345644"),
		array("Hannah", "220408", "0812345655") 
	);



	$student = array_merge($student, $student_baru);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<h3>Data Seluruh Mahasiswa : </h3>
	<table border="1" cellpadding="5" cellspacing="2">
		<thead>
			<tr>
				<th><b>Name</b></th>
				<th><b>NIM</b></th>
				<th><b>Mobile</b></th>
			</tr>
		</thead>
		<tbody>
            <?php 
	            foreach ($student as $row) {
	                echo "<tr>";
	                echo "<td>" . $row[0] . "</td>";
	                echo "<td>" . $row[1] . "</td>";
	                echo "<td>" . $row[2] . "</td>";
	                echo "</tr>";
            	};
            ?>
        </tbody>
	</table>	
</body>
</html>
