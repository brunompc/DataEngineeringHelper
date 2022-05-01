# DataEngineeringHelper

A set of PHP utilities to help with common data engineering tasks.

## Database utilities

These database utilities are not ready to properly handle potential SQL Injections, so they should only be used in controlled environments (i.e. not exposed to the 
public).

**getArrayFromDb($host, $database, $username, $password, $sql)**
- Receives database connection information and an SQL query.
- Returns an array of database rows that result from executing the SQL query.

Example usage:
```
$user = "macgyver";
$pass = "mr-t-eats-bananas";
$database = "university";
$query = "select * from student";
$dbRows = getArrayFromDb("localhost", $database, $user, $pass, $query);
print_r($dbRows);
```

## CSV utilities

**readArrayFromCSV($filename, $ignore_first_line = true)**
- reads a CSV file into an array
- The argument $ignore_first_line should be used when the first line of the file is a header that should not be included in the array.

Example usage:
```
$students = readArrayFromCSV("students.csv", true);
echo "<pre>";
print_r($students);
echo "</pre>";
```

**writeArrayToCSV($array, $filename, $header, $separator = ",")**
- Receives an array, the target CSV's filename and header, and an optional $separator which defaults to ",".
- Writes the array's contents to a file

Example usage:
```
$people = array(array("id" => 1, "name" => "bc"), array("id" => 2, "name" => "rcc"));
$header = "ID,NAME";
writeArrayToCSV($people, "people.csv", $header);
```

## JSON utilities
Nothing available yet.

## (Generic) Array utilities
**remove_if_not($array, $field, $validation_function, $return_ignored_arrays)**
- Creates an array based on argument $array, excluding any element whose value for argument $field is not valid according the argument $validation_function.
- $array is an array;
- $field is a string or integer, identifying the array element that will be tested;
- $validation_function is the name of a function that receives one argument and returns a boolean;
- $return_ignored_arrays is a boolean, indicating if the ignored sub-arrays shall be returned as an independent value. Defaults to false;
- Returns: an array with two elements; The first element is the filtered array. The second element is an array with the ignored sub-arrays. If $return_ignored_arrays
is false, the second array will be empty.

```Example usage:
function largerThanZero($n) {
	return $n > 0;
}
$array = array(array("id" => -1, "name" => "Neo"), 
		array("id" => 1, "name" => "MacGyver"), 
		array("id" => 2, "name" => "Donald Duck"));
$res = remove_if_not($array, "id", "largerThanZero");
```

**remove_if_not_multi($array, $fields_and_functions, $return_ignored_arrays)**
- Similar to remove_if_not(), but supports checking multiple fields, using different functions per field.
- $fields_and_functions is an associative array, where the key is the name of a field/index that exists in sub-arrays of $array, and the value is a function that
will be used to validate that field's value;
- $return_ignored_arrays is a boolean, indicating if the ignored sub-arrays shall be returned as an independet value. Defaults to false;
- Returns: an array with two elements; The first element is the filtered array. The second element is an array with the ignored sub-arrays. If $return_ignored_arrays
is false, the second array will be empty.

```Example usage:
function largerThanZero($n) {
	return $n > 0;
}
function moreThanFiveLetters($str) {
	return strlen($str) >= 5;
}
$array = array(array("id" => -1, "name" => "Neo"), 
		array("id" => 1, "name" => "MacGyver"), 
		array("id" => 2, "name" => "Donald Duck"));
// field "id" will be validated by function largerThanZero($nr)
// while field "name" will be validated by function moreThanFiveLetters($str)
$fields_and_functions = array("id" => "largerThanZero", "name" => "moreThanFiveLetters");
$res = remove_if_not_multi($array, $fields_and_functions);
```

**merge_arrays($arr_1, $arr_2, $key_s1, $key_s2, $ignore_unmatched_arrays, $return_unmatched_arrays)**
- Receives two arrays and the identifiers of two keys and merges the two arrays whenever the values of each array/key are the same.
- If the argument $ignore_unmatched_arrays is true, then 
- If the argument $return_unmatched_arrays is true, then the function will return an array of arrays, where 
the fist element is the array with the result of the merge, and the second element is an array with the unmatched lines from both sources.

```Example usage:
$data1 = array(
		array("id" => 123, "name" => "Neo"),
		array("id" => 456, "name" => "Jack"),
		array("id" => 333, "name" => "Peter"));

$data2 = array(
		array("p_id" => "123", "surname" => "(The One)"),
		array("p_id" => "456", "surname" => "Sparrow"),
		array("p_id" => "777", "surname" => "Trinity"));

// This call with merge the first two entries of each array.
// The last entry of each array is not merged because 333 only exists in $data1 
// and 777 only exists in $data2.
$merged = merge_data_sources($data1, $data2, "id", "p_id")
```

## Full Example

```
<?php

require_once(“DataEngineeringHelper\\functions.php”);

function atLeastFiveChars($string) {
	return strlen($string) >= 5;
}

// get all the records from a DB table
$students = getArrayFromDb("localhost", "school_records", "root", "", "select * from students");

// Remove any records which have less than 5 chars in the field "name"
$filtered_students = remove_if_not_by_field($registos, "name", "atLeastFiveChars");
$valid_students = $filtered_students[0];

// Write the remaining records to a CSV file
writeArrayToCSV($valid_students, "students.csv");

?>
```
