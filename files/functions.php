<?php

$array = array(
				array("id" => 0, "nome" => "Bruno"),
				array("id" => 1, "nome" => "Rodrigo"),
				array("id" => 2, "nome" => "Raquel"),
				array("id" => 3, "nome" => "Sara"));

print_r($array);

writeArrayToCSV($array, "teste.csv.txt", "ID,NOME", ",");

function writeArrayToCSV($array, $filename, $header, $separator = ",", $columns_to_exclude = null) {
	$fp = fopen($filename, "w");
	$lines = "" . $header . "\n";
	for($i = 0; $i < sizeof($array); $i++) {
		$line = "";
		$first = true;
		foreach($array[$i] as $column=>$value) {
			//if($column)
			if(!$first) {
				$line = $line . $separator;
			}
			$line = $line . $value;
			$first = false;
		}
		$lines = $lines . $line . "\n";
	}
	fwrite($fp, $lines);
	fclose($fp);
}

?>
