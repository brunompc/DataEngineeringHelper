<?php

/**
	remove_if_not(...)
	Removes from an array any elements that do not satisfy a certain predicate function.

	Arguments:
	- $array is an array
	- $function is the name of a function that will receive each of $array's 
	elements and "validate it". If the function returns true, then the element will be kept 
	in the array. Otherwise, it will be removed.
	- $return_ignored_elements is a boolean.

	Returns:
	- an array with two sub-arrays:
	-- the first array will contain the elements from the original $array that satisfied the predicate;
	-- the second array will contain the elements from the original $array that did not satisfy the predicate. If arg 
	$return_ignored_elements is false, this array will be empty.
*/
function remove_if_not($array, $function, $return_ignored_elements = false) {
	$res = array();
	$ignored = array();
	for($i=0; $i<count($array); $i++) {
		$sub_array = $array[$i];
		if($function($sub_array)) {
			$res[] = $sub_array;
		}
		else if($return_ignored_elements) {
			$ignored[] = $sub_array;
		}
	}
	return array($res, $ignored);
}

/**
	remove_if_not_by_field(...)
	Removes from an array any elements that do not satisfy a certain predicate function.
	
	Arguments:
	- $array is an array;
	- $field is an element index or a field name (i.e. for associative arrays)
	- $function is the name of a function that will receive each of the $array's1_key
	elements and "validate it". If the function returns true, then the elements will ke bept
	in the array. Otherwise, it will be removed.

	Returns:
	- An array with two sub-arrays:
	-- the first array will contain the elements from the original $array that satisfied the predicate;
	-- the second array will contain the elements from the original $array that did not satisfy the predicate. If arg 
	$return_ignored_elements is false, this array will be empty.
*/
function remove_if_not_by_field($array, $field, $function, $return_ignored_elements = false) {
	$res = array();
	$ignored = array();
	for($i=0; $i<count($array); $i++) {
		$sub_array = $array[$i];
		if($function($sub_array[$field]) == true) {
			$res[] = $sub_array;
		}
		else if($return_ignored_elements) {
			$ignored[] = $sub_array;
		}
	}
	return array($res, $ignored);
}

/**
	remove_if_not_by_multi_fields(...)
	Removes from an array any elements that do not satisfy a certain predicate function.
	
	Arguments:
	- $array is an array;
	- $fields and functions is an associative array, mapping indexes or field names to validation functions.
	- $return_ignored_elements is a boolean. If the function returns true, then the elements will be kept
	in the array.
	Returns:
	- An array with two sub-arrays:
	-- the first array will contain the elements from the original $array that satisfied the predicate;
	-- the second array will contain the elements from the original $array that did not satisfy the predicate. If arg 
	$return_ignored_elements is false, this array will be empty.	
*/
function remove_if_not_by_multi_fields($array, $fields_and_functions, $return_ignored_elements = false) {
	$res = array();
	$ignored = array();
	for($i=0; $i<count($array); $i++) {
		$sub_array = $array[$i];
		$ignore = false;
		foreach($sub_array as $key => $value) {
			foreach($fields_and_functions as $field => $function) {
				if($key == $field && $function ($value) == false) {
					$ignore = true;
					break;
				}
			}
		}
		if(!$ignore) {
			$res[] = $sub_array;
		}
		else if($return_ignored_elements) {
			$ignored[] = $sub_array;
		}
	}
	return array($res, $ignored);
}

?>
