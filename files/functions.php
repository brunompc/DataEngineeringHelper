<?php

/**
 * writeArrayToFile()
 *
 * Arguments:
 * - $array an array that will be written to a file
 * - $filename a string with the name of the file where the array will be written
 *
 * Returns: void
 * 
 */
function writeArrayToFile($array, $filename) {
	// lazy town
	writeArraytoCSV($array, $filename, null);
}

/**
 * writeArrayToCSV()
 *
 * Arguments:
 * - $array an array that will be written to a file
 * - $filename is a string with the name of the file where the array will be written
 * - $header is an array of strings. Each string should correspond to the name of a CSV column.
 * - $separator is a string with the separator that will be used between each value that is written to the file
 
 * Returns: void
 *
 */
function writeArrayToCSV($array, $filename, $header = null, $separator = ",") {
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

/**
 * readArrayFromCSV()
 * Reads a CSV file into an array.
 *
 * Arguments:
 * - $filename is a string with the name of the file that should be read;
 * - $ignore_first_line is a boolean, indicating if the file's first line should be read or ignored (i.e. if it contains a header that should not be placed in the array);
 * - $separator is a string with the value-separator that is used in the file. Defaults to ",".
 * Returns:
 * - an array
 *
 */
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
