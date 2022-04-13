<?php

function remove_if_not($array, $field, $function, $return_ignored_arrays = false) {
	$res = array();
	$ignored = array();
	for($i=0; $i<count($array); $i++) {
		$sub_array = $array[$i];
		if($function($sub_array[$field]) == true) {
			$res[] = $sub_array;
		}
		else if($return_ignored_arrays) {
			$ignored[] = $sub_array;
		}
	}
	return array($res, $ignored);
}

function remove_if_not_multi($array, $fields_and_functions, $return_ignored_arrays = false) {
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
		else if($return_ignored_arrays) {
			$ignored[] = $sub_array;
		}
	}
	return array($res, $ignored);
}

?>
