<?php

function writeArrayToFile($array, $filename, $append = false) {
	// lazy town
	writeArraytoCSV($array, $filename, null);
}

function writeArrayToCSV($array, $filename, $header = null, $separator = ",", $columns_to_exclude = null) {
	$lines = "";
	if($header != null) {
		$lines = $header . "\n";
	}
	for($i = 0; $i < sizeof($array); $i++) {
		$line = "";
		$first = true;
		foreach($array[$i] as $column=>$value) {
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
	$result = array();
	$first_line = true;
	$fp = fopen($filename, "r");
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
