<?php
	
	// Array_push
	echo "<h3>1. Array_push </h3>";
	$aray_P = ["A"];
	array_push($aray_P,"B");
	echo "Array awal : ($aray_P[0])"."<br>";
	echo "Hasil array_push : ".implode(" ",$aray_P);

	echo "<br>";

	// Array_Merge
	echo "<h3>2. Array_merge </h3>";
	$aray_M1 = ["A", "B"];
	$aray_M2 = ["C"];

	$aray_merge = array_merge($aray_M1,$aray_M2);
	echo "Hasil array_merge : ".implode(" ",$aray_merge);

	// Array_Value
	echo "<h3>3. Array_value </h3>";
	$aray_V = ["x" => 1, "y" => 2];
	array_values($aray_V);
	echo "Hasil array_value : ".implode(" ",$aray_V);

	// Array_search
	echo "<h3>4. Array_search </h3>";
	$aray_S = ["A","B","C"];
	echo "Hasil array_search : ".array_search("B", $aray_S);

	// Array_filter
	echo "<h3>4. Array_filter </h3>";
	$aray_f = [0,1,false,2,"",3,"array"];
	echo "Hasil array_filter : ".implode(" ",array_filter($aray_f));

	// Array_sort & rsort
	echo "<h3>4. Array_sort&rsort </h3>";
	$aray_SR = [3,2,1];
	sort($aray_SR);
	echo "Hasil sort : ".implode(" ",$aray_SR)."<br>";
	rsort($aray_SR);
	echo "Hasil rsort : ".implode(" ",$aray_SR)."<br>";


	// Array_sort & rsort
	echo "<h3>4. Array_sort&rsort pada array asosiatif </h3>";
	$aray_ASR = ["Peter" => 35, "Ben" => 37, "Joe" => 43];

	echo "Array awal : ";
		foreach ($aray_ASR as $key => $value) {
		echo "$key => $value , ";
	};
	echo "<br>";
	asort($aray_ASR);
	echo "Hasil asort : ";
		foreach ($aray_ASR as $key => $value) {
		echo "$key => $value , ";
	};
	echo "<br>";
	ksort($aray_ASR);
	echo "Hasil ksort : ";
		foreach ($aray_ASR as $key => $value) {
		echo "$key => $value , ";
	};
	echo "<br>";
	arsort($aray_ASR);

	echo "Hasil arsort : ";
		foreach ($aray_ASR as $key => $value) {
		echo "$key => $value , ";
	};
	echo "<br>";
	krsort($aray_ASR);
	echo "Hasil krsort : ";
	foreach ($aray_ASR as $key => $value) {
		echo "$key => $value , ";
	};
	
?>
