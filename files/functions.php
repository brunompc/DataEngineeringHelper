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
	$fp = fopen($filename, "w");
	fwrite($fp, $lines);
	fclose($fp);
}

function readArrayFromCSV($filename, $ignore_first_line = true, $separator = ",") {
	$fp = fopen($filename, "r");
	echo $fp;
	$result = array();
	$first_line = true;
	while(!feof($fp)) {
		$line = fgets($fp);
		if($first_line && $ignore_first_line) {
			$first_line = false;
			continue;
		}
		$result[] = explode($separator, $line);
	}
	return $result;
}

?>
